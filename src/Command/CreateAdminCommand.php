<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// Bootstraps a real ROLE_ADMIN account with an operator-chosen password.
// Exists specifically so production never needs doctrine:fixtures:load (which
// isn't even available there — DoctrineFixturesBundle is dev/test only) or
// the fixture accounts committed in src/DataFixtures/UserFixtures.php, whose
// email/password pairs are public in this repo's history.
#[AsCommand(
    name: 'app:create-admin',
    description: 'Create a ROLE_ADMIN user with a password you provide (does not touch fixtures).',
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email')
            ->addArgument('firstName', InputArgument::REQUIRED, 'First name')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Last name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = (string) $input->getArgument('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $io->error(sprintf('"%s" is not a valid email address.', $email));

            return Command::FAILURE;
        }

        if ($this->userRepository->findOneBy(['email' => $email])) {
            $io->error(sprintf('A user with email "%s" already exists.', $email));

            return Command::FAILURE;
        }

        $question = new Question('Password (input hidden, 10+ characters): ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);
        $password = $this->getHelper('question')->ask($input, $output, $question);

        if (!\is_string($password) || \strlen($password) < 10) {
            $io->error('Password must be at least 10 characters.');

            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setFirstName((string) $input->getArgument('firstName'));
        $user->setLastName((string) $input->getArgument('lastName'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('Admin user "%s" created.', $email));

        return Command::SUCCESS;
    }
}
