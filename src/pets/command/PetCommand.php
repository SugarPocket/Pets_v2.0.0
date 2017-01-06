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
			$sender->sendMessage("§e======ช่วยเหลือ======");
			$sender->sendMessage("§a/pets type §6[type]");
			$sender->sendMessage("§aตัวอย่าง §b /pets type pig");
			$sender->sendMessage("§eTypes: dog, rabbit, pig, cat, chicken, zombie, snowgolem ,spider ,irongolem ,bat");
			$sender->sendMessage("§b/pets off §6ปิดสัตว์เลี้ยง");
			$sender->sendMessage("§b/pets setname §6ตั้งชื่อสัตว์");
			$sender->sendMessage("§b/pets info §6ดูเวอชั่น ปลักอินสัตว์");
			$sender->sendMessage("§b/pets size §6เปลี่ยนขนาดสัตย์เลี้ยง");
			
			return true;
		}
		switch (strtolower($args[0])){
			case "name":
			case "setname":
			case "ตั้งชื่อ":
				if (isset($args[1])){
					unset($args[0]);
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag($name);
					$sender->sendMessage("§aได้เปลี่ยนชื่อสัตว์เป็น ".$name);
					$data = new Config($this->main->getDataFolder() . "players/" . strtolower($sender->getName()) . ".yml", Config::YAML);
					$data->set("name", $name); 
					$data->save();
				}
				return true;
			break;
			case "info":
			case "ข้อมูล":
                $sender->sendMessage("\n.\n§aสัตว์เลี้ยงเวอฃั่น  §e4.0.0 §9พัฒนาโดย §eSugarPocket\n.");
				return true;
			break;
			case "size":
			case "ขนาด":
                $sender->sendMessage("\n.\n§cเร็วๆนี้...\n.");
				return true;
			case "help":
			case "ช่วยเหลือ":
				$sender->sendMessage("§e======ช่วยเหลือ======");
				$sender->sendMessage("§a/pets type §6[type]");
				$sender->sendMessage("§aตัวอย่าง §b /pets type pig \n §b/pets เลือก หมู");
				$sender->sendMessage("§eTypes: dog§6=§eหมา rabbit§6=§eกระต่าย pig§6=§eหมู cat§6=§eแมว chicken§6=§eไก่ zombie§6=§eซอมบี้ spider§6=§eแมงมุม irongolem§6=§eโกเล็ม Horse§6=§eม้า ZombieHorse§6=§eม้าซอมบี้ Donkey§6=§eลา SkeletonHorse§6=§eม้าผีกระดูก Mule§6=§eล่อ Guardian§6=§eการ็เดียน Wither§6=§eวิทเธอร์ Bat§6=§eค้างคาว");
				$sender->sendMessage("§b/pets off §6ปิดสัตว์เลี้ยง");
				$sender->sendMessage("§b/pets setname §6ตั้งชื่อสัตว์");
				$sender->sendMessage("§b/pets info §6ดูเวอชั่น ปลักอินสัตว์");
				$sender->sendMessage("§b/pets size §6เปลี่ยนขนาดสัตย์เลี้ยง");
				return true;
			break;
			case "off":
			case "ปิด":
				$this->main->disablePet($sender);
				$sender->sendMessage("§bคุณได้เลิกเลี้ยงสัตว์เเล้ว");
			break;
			case "type":
			case "เลือก":
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
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยนเป็น กระต่าย");
							return true;
						break;
						case "cat":
							$this->main->changePet($sender, "OcelotPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น แมว");
							return true;
						break;
						case "chicken":
							$this->main->changePet($sender, "ChickenPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น ไก่");
							return true;
						break;
						case "zombie":
							$this->main->changePet($sender, "(ZombiePet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น ซอมบี้!");
							return true;
						break;
						case "spider":
							$this->main->changePet($sender, "SpiderPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น แมงมุม!");
							return true;
						break;
						case "snowgolem":
							$this->main->changePet($sender, "SnowGolemPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น สโนโกเล็ม!");
							return true;
						break;
						case "irongolem":
							$this->main->changePet($sender, "IronGolemPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น ไอร่อนโกเล็ม!");
							return true;
						break;
						case "bat":
							$this->main->changePet($sender, "BatPet");
							$sender->sendMessage("§aสัตว์เลี้ยงของคุณได้เปลี่ยน เป็น ค้างคาว!");
							return true;
						break;
						//case "Wich":
							//$this->main->changePet($sender, "WichPet");
							//$sender->sendMessage("สัตว์เลี้ยงของคุณได้เปลี่ยน เป็น พ่อมด!");
							//return true;
						//break;
					default:
						$sender->sendMessage("§e======ช่วยเหลือ======");
						$sender->sendMessage("§a/pets type §6[type]");
						$sender->sendMessage("§aตัวอย่าง §b /pets type pig");
						$sender->sendMessage("§eTypes: dog, rabbit, pig, cat, chicken, zombie, snowgolem ,spider ,irongolem ,bat");
						$sender->sendMessage("§b/pets off §6ปิดสัตว์เลี้ยง");
						$sender->sendMessage("§b/pets setname §6ตั้งชื่อสัตว์");
						$sender->sendMessage("§b/pets info §6ดูเวอชั่น ปลักอินสัตว์");
						$sender->sendMessage("§b/pets size §6เปลี่ยนขนาดสัตย์เลี้ยง");
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
