<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter\commands\subcommands;

use pocketmine\command\CommandSender;
use CortexPE\Commando\BaseSubCommand;

/**
 * Class RemoveProfanity
 * @package NhanAZ\ProfanityFilter\commands\subcommands
 */
class RemoveProfanity extends BaseSubCommand {

	/**
	 * prepare
	 *
	 * @return void
	 */
	protected function prepare(): void {
		// $this->setPermission("profanityfilter.remove");
	}

	/**
	 * onRun
	 *
	 * @param CommandSender $sender
	 * @param string $aliasUsed
	 * @param array<string> $args
	 *
	 * @return void
	 */
	public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
	}
}
