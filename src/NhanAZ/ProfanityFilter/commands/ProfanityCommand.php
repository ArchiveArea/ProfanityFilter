<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter\commands;

use pocketmine\command\CommandSender;
use NhanAZ\ProfanityFilter\commands\subcommands\AddProfanity;
use NhanAZ\ProfanityFilter\commands\subcommands\RemoveProfanity;
use NhanAZ\ProfanityFilter\commands\subcommands\ListProfanity;
use NhanAZ\ProfanityFilter\commands\subcommands\SettingProfanity;
use CortexPE\Commando\BaseCommand;

/**
 * Class ProfanityCommand
 * @package NhanAZ\ProfanityFilter\commands
 */
class ProfanityCommand extends BaseCommand {

	/**
	 * prepare
	 *
	 * @return void
	 */
	protected function prepare(): void {
		// $this->setPermission("profanity");
		/**
		 * /profanity add <string>
		 */
		$this->registerSubCommand(new AddProfanity("add", "Add Profanity"));
		/**
		 * /profanity remove <string>
		 */
		$this->registerSubCommand(new RemoveProfanity("remove", "Remove Profanity"));
		/**
		 * /profanity list
		 * Send list profanity
		 */
		$this->registerSubCommand(new ListProfanity("list", "List Profanity"));
		/* 
		 * /profanity setting
		 * Send a form to player
		 */
		$this->registerSubCommand(new SettingProfanity("setting", "Setting Profanity"));
	}

	/**
	 * onRun
	 *
	 * @param CommandSender $sender
	 * @param string $aliasUsed
	 * @param array $args
	 *
	 * @return void
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
		// TODO
	}
}
