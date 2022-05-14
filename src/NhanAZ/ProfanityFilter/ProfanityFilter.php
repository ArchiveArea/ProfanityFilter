<?php

declare(strict_types=1);

namespace NhanAZ\ProfanityFilter;

use pocketmine\lang\Language;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat;
use function array_map;
use function is_dir;
use function is_file;
use function mb_strlen;
use function mkdir;
use function preg_match;
use function sizeof;
use function str_repeat;
use function str_replace;
use function strtolower;
use function strval;

/**
 * Class ProfanityFilter
 * @package NhanAZ\ProfanityFilter
 */
class ProfanityFilter extends PluginBase {
	use SingletonTrait;

	protected Config $config;

	protected Config $profanities;

	private static Language $language;

	/** @var array<string> $languages */
	private array $languages = [
		"eng",
		"vie"
	];

	/**
	 * getLanguage
	 */
	public static function getLanguage() : Language {
		return self::$language;
	}

	/**
	 * initLanguageFiles
	 *
	 * @param string[] $languageFiles
	 */
	public function initLanguageFiles(string $lang, array $languageFiles) : void {
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
	 */
	protected function onLoad() : void {
		self::setInstance($this);
	}

	/**
	 * initResource
	 */
	private function initResource() : void {
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
		$this->saveResource("profanities.yml");
		$this->profanities = new Config($this->getDataFolder() . "profanities.yml", Config::YAML);
	}

	/**
	 * checkVersion
	 */
	private function checkVersion() : void {
		if (VersionInfo::IS_DEVELOPMENT_BUILD) { /* @phpstan-ignore-line (If condition is always true.) */
			$isDevelopmentBuild = ProfanityFilter::getLanguage()->translateString("is.development.build");
			$this->getLogger()->warning($isDevelopmentBuild);
		}
	}

	/**
	 * onEnable
	 */
	protected function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->initResource();
		$this->initLanguageFiles(strval($this->config->get("language", "eng")), $this->languages);
		$this->checkVersion();
	}

	/**
	 * getPrefix
	 */
	public function getPrefix() : string {
		return strval($this->config->get("prefix", "&f[&cProfanityFilter&f]&r "));
	}

	/**
	 * getProfanities
	 */
	public function getProfanities() : mixed {
		return $this->profanities->get("profanities", ["wtf", "đụ"]);
	}

	/**
	 * getWarningMode
	 */
	public function getWarningMode() : bool {
		return (bool) $this->config->get("warningMode", true);
	}

	/**
	 * getCharacterReplaced
	 */
	public function getCharacterReplaced() : string {
		return strval($this->config->get("characterReplaced", "*"));
	}

	/**
	 * getShowProfanity
	 */
	public function getShowProfanity() : bool {
		return (bool) $this->config->get("showProfanity", true);
	}

	/**
	 * containsProfanity
	 */
	public function containsProfanity(string $msg) : bool {
		$profanities = (array) $this->getProfanities();
		$filterCount = sizeof($profanities);
		for ($i = 0; $i < $filterCount; $i++) {
			$condition = preg_match('/' . $profanities[$i] . '/iu', $msg) > 0;
			if ($condition) {
				return true;
			}
		}
		return false;
	}

	/**
	 * warningPlayer (Send a warning to players if their messages contain profanity)
	 */
	public function warningPlayer(Player $player) : void {
		if ($this->getWarningMode()) {
			$prefix = $this->getPrefix();
			$warningMessage = ProfanityFilter::getLanguage()->translateString("warning.message");
			$colorize = TextFormat::colorize($prefix . $warningMessage);
			$player->sendMessage($colorize);
		}
	}

	/**
	 * handleMessage
	 */
	public function handleMessage(string $msg) : string {
		$profanities = $this->getProfanities();
		$callback = function (string $profanities) : string {
			$character = $this->getCharacterReplaced();
			$search = $profanities;
			$replace = str_repeat(strval($character), mb_strlen($profanities, "utf8"));
			$subject = $profanities;
			$profanities = str_replace($search, $replace, $subject);
			return $profanities;
		};
		$array = $profanities;
		$search = $profanities;
		$replace = array_map(strval($callback), (array) $array);
		$subject = strtolower($msg);
		// TODO: Use preg_replace instead of str_replace (Help Wanted)
		$filteredMsg = str_replace((array) $search, $replace, $subject);
		return $filteredMsg;
	}

	/**
	 * showProfanity
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
