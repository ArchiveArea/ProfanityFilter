<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter\commands\subcommands;

use pocketmine\command\CommandSender;
use CortexPE\Commando\BaseSubCommand;

/**
 * Class ListProfanity
 * @package NhanAZ\ProfanityFilter\commands\subcommands
 */
class ListProfanity extends BaseSubCommand {

	/**
	 * prepare
	 *
	 * @return void
	 */
	protected function prepare(): void {
		// $this->setPermission("profanityfilter.list");
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
	}
}
