<?php

namespace pets\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pets\main;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class PetCommand extends PluginCommand {

	public function __construct(main $main, $name) {
		parent::__construct(
				$name, $main
		);
		$this->main = $main;
		$this->setPermission("pets.command");
		$this->setAliases(array("pets"));
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
	if($sender->hasPermission('pets.command')){
		if (!isset($args[0])) {
			$sender->sendMessage("§e======PetHelp======");
			$sender->sendMessage("§a/pets type [type]");
			$sender->sendMessage("§eTypes: dog, rabbit, pig, cat, chicken, zombie, snowgolem ,spider ,irongolem ,bat");
			$sender->sendMessage("§b/pets off to set your pet off");
			
			return true;
		}
		switch (strtolower($args[0])){
			case "name":
			case "setname":
				if (isset($args[1])){
					unset($args[0]);
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag($name);
					$sender->sendMessage("Set Name to ".$name);
					$data = new Config($this->main->getDataFolder() . "players/" . strtolower($sender->getName()) . ".yml", Config::YAML);
					$data->set("name", $name); 
					$data->save();
				}
				return true;
			break;
			case "help":
				$sender->sendMessage("§e======PetHelp======");
				$sender->sendMessage("§a/pets type [type]");
				$sender->sendMessage("§eTypes: dog, rabbit, pig, cat, chicken ,zombie, snowgolem ,spider ,irongolem ,bat");
				$sender->sendMessage("§b/pets off to set your pet off");
				return true;
			break;
			case "off":
				$this->main->disablePet($sender);
			break;
			case "type":
				if (isset($args[1])){
					switch ($args[1]){
						case "wolf":
						case "dog":
							$this->main->changePet($sender, "WolfPet");
							$sender->sendMessage("§aYour pet has changed to Wolf!");
							return true;
						break;
						case "pig":
							$this->main->changePet($sender, "PigPet");
							$sender->sendMessage("§aYour pet has changed to Pig!");
							return true;
						break;
						case "rabbit":
							$this->main->changePet($sender, "RabbitPet");
							$sender->sendMessage("§aYour pet has changed to Rabbit!");
							return true;
						break;
						case "cat":
							$this->main->changePet($sender, "OcelotPet");
							$sender->sendMessage("§aYour pet has changed to Cat!");
							return true;
						break;
						case "chicken":
							$this->main->changePet($sender, "ChickenPet");
							$sender->sendMessage("§aYour pet has changed to Chicken!");
							return true;
						break;
						case "zombie":
							$this->main->changePet($sender, "ChickenPet");
							$sender->sendMessage("§aYour pet has changed to Chicken!");
							return true;
						break;
						case "spider":
							$this->main->changePet($sender, "SpiderPet");
							$sender->sendMessage("§aYour pet has changed to Spider!");
							return true;
						break;
						case "snowgolem":
							$this->main->changePet($sender, "SnowGolemPet");
							$sender->sendMessage("§aYour pet has changed to SnowGolem!");
							return true;
						break;
						case "irongolem":
							$this->main->changePet($sender, "IronGolemPet");
							$sender->sendMessage("§aYour pet has changed to IronGolem!");
							return true;
						break;
						case "bat":
							$this->main->changePet($sender, "BatPet");
							$sender->sendMessage("§aYour pet has changed to Bat!");
							return true;
						break;
						//case "Wich":
							//$this->main->changePet($sender, "WichPet");
							//$sender->sendMessage("Your pet has changed to Wich!");
							//return true;
						//break;
					default:
						$sender->sendMessage("§a/pets type [type]");
						$sender->sendMessage("§bTypes: dog, rabbit, pig, cat, chicken, zombie, snowgolem ,spider ,irongolem ,bat");
					break;	
					return true;
					}
				}
			break;
		}
		return true;
	}
	}
}
