<?php

namespace usy4\JoinStreak;

use usy4\JoinStreak\commands\JoinStreak;
use usy4\JoinStreak\EventListener;

use CortexPE\Commando\PacketHooker;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase{

    public static $config;

    public function onEnable() : void{
        if (!PacketHooker::isRegistered()){
            PacketHooker::register($this);
        }
        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);
        Server::getInstance()->getCommandMap()->register($this->getName(), new JoinStreakCommand($this, "joinstreak", "joinstreak cmd", aliases: ["js"])); 
        $this->saveDefaultConfig();
        self::$config = $this->getConfig();
    }

}