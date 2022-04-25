<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter;

use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\lang\Language;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use NhanAZ\ProfanityFilter\VersionInfo;
use function is_dir;
use function mkdir;
use function is_file;
use function strrchr;
use function strval;
use function str_repeat;
use function mb_strlen;
use function str_replace;
use function array_map;
use function strtolower;

/**
 * Class ProfanityFilter
 * @package NhanAZ\ProfanityFilter
 */
class ProfanityFilter extends PluginBase {

	use SingletonTrait;

	/**
	 * @var Config $config
	 */
	protected Config $config;

	/**
	 * @var Config $profanities
	 */
	protected Config $profanities;

	/**
	 * @var Language $language
	 */
	private static Language $language;

	/**
	 * @var array<string> $languages
	 */
	private array $languages = [
		"eng",
		"vie"
	];

	/**
	 * getLanguage
	 *
	 * @return Language
	 */
	public static function getLanguage(): Language {
		return self::$language;
	}

	/**
	 * initLanguageFiles
	 *
	 * @param string $lang
	 * @param string[] $languageFiles
	 *
	 * @return void
	 */
	public function initLanguageFiles(string $lang, array $languageFiles): void {
		$path = $this->getDataFolder() . "languages/";
		if (!is_dir($path)) {
			@mkdir($path);
		}
		foreach ($languageFiles as $file) {
			if (!is_file($path . $file . ".ini")) {
				$this->saveResource("languages/" . $file . ".ini");
			}
		}
		self::$language = new Language($lang, $path);
	}

	/**
	 * onLoad
	 *
	 * @return void
	 */
	protected function onLoad(): void {
		self::setInstance($this);
	}

	/**
	 * initResource
	 *
	 * @return void
	 */
	private function initResource(): void {
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
		$this->saveResource("profanities.yml");
		$this->profanities = new Config($this->getDataFolder() . "profanities.yml", Config::YAML);
	}

	/**
	 * checkVersion
	 *
	 * @return void
	 */
	private function checkVersion(): void {
		if (VersionInfo::IS_DEVELOPMENT_BUILD) { /* @phpstan-ignore-line (If condition is always true.) */
			$isDevelopmentBuild = ProfanityFilter::getLanguage()->translateString("is.development.build");
			$this->getLogger()->warning($isDevelopmentBuild);
		}
	}

	/**
	 * onEnable
	 *
	 * @return void
	 */
	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->initResource();
		$this->initLanguageFiles(strval($this->config->get("language", "eng")), $this->languages);
		$this->checkVersion();
	}

	/**
	 * getPrefix
	 *
	 * @return string
	 */
	public function getPrefix(): string {
		return strval($this->config->get("prefix", "&f[&cProfanityFilter&f]&r "));
	}

	/**
	 * getProfanities
	 *
	 * @return mixed
	 */
	public function getProfanities(): mixed {
		return $this->profanities->get("profanities", ["wtf", "đụ"]);
	}

	/**
	 * getWarningMode
	 *
	 * @return bool
	 */
	public function getWarningMode(): bool {
		return (bool)$this->config->get("warningMode", true);
	}

	/**
	 * getCharacterReplaced
	 *
	 * @return string
	 */
	public function getCharacterReplaced(): string {
		return strval($this->config->get("characterReplaced", "*"));
	}

	/**
	 * getShowProfanity
	 *
	 * @return bool
	 */
	public function getShowProfanity(): bool {
		return (bool)$this->config->get("showProfanity", true);
	}

	/**
	 * containsProfanity
	 *
	 * @param string $msg
	 *
	 * @return bool
	 */
	public function containsProfanity(string $msg): bool {
		$profanities = $this->getProfanities();
		/**
		 * @phpstan-ignore-next-line
		 * Argument of an invalid type mixed supplied for foreach, only iterables are supported.
		 */
		foreach ($profanities as $profanitie) {
			if ((bool)strrchr(strtolower($msg), strval($profanitie))) {
				return true;
			}
		}
		return false;
	}

	/**
	 * warningPlayer (Send a warning to players if their messages contain profanity)
	 *
	 * @param Player $player
	 *
	 * @return void
	 */
	public function warningPlayer(Player $player): void {
		if ($this->getWarningMode()) {
			$prefix = $this->getPrefix();
			$warningMessage = ProfanityFilter::getLanguage()->translateString("warning.message");
			$colorize = TextFormat::colorize($prefix . $warningMessage);
			$player->sendMessage($colorize);
		}
	}

	/**
	 * handleMessage
	 *
	 * @param string $msg
	 *
	 * @return string
	 */
	public function handleMessage(string $msg): string {
		$profanities = $this->getProfanities();
		$callback = function (string $profanities): string {
			$character = $this->getCharacterReplaced();
			$search = $profanities;
			$replace = str_repeat(strval($character), mb_strlen($profanities, "utf8"));
			$subject = $profanities;
			$profanities = str_replace($search, $replace, $subject);
			return $profanities;
		};
		$array = $profanities;
		$search = $profanities;
		/**
		 * @phpstan-ignore-next-line
		 * Parameter #3 $subject of function str_replace expects array|string, mixed given.
		 */
		$replace = array_map($callback, (array)$array);
		$subject = strtolower($msg);
		// TODO: Use preg_replace instead of str_replace (Help Wanted)
		$filteredMsg = str_replace((array)$search, $replace, $subject);
		return $filteredMsg;
	}

	/**
	 * showProfanity
	 *
	 * @param Player $player
	 * @param string $msg
	 *
	 * @return void
	 */
	public function showProfanity(Player $player, string $msg) {
		if ($this->getShowProfanity()) {
			$warningMessage = $this->config->get("warningMessage", "{playerName} > {msg}");
			// TODO: Implement InfoAPI Here (Help Wanted)
			$search = [
				"{playerName}",
				"{msg}"
			];
			$replace = [
				$player->getName(),
				$msg
			];
			$subject = $warningMessage;
			$this->getLogger()->info(str_replace($search, $replace, strval($subject)));
		}
	}
}
