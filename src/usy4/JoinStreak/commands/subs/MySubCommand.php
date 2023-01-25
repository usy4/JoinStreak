<?php

namespace usy4\JoinStreak\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

use usy4\JoinStreak\Main;

class MySubCommand extends BaseSubCommand {

    protected function prepare(): void {
        //nothing
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        $name = $sender->getName();
        $config = Main::$config;
        if($config->exists($name)){
            $streak = $config->get($name);
            $sender->sendMessage("§7Your join streak is §c$streak§7 days.");
        } else {
            $sender->sendMessage("§7You have no join streak yet.");
        }
    }

}