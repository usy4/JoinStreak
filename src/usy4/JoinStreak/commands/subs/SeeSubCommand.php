<?php

namespace usy4\JoinStreak\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

use usy4\JoinStreak\commands\TargetPlayerArgument;
use usy4\JoinStreak\Main;

class SeeSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        $this->registerArgument(0, new TargetPlayerArgument(true));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if(count($args) < 1){
            $sender->sendMessage("Usage: /joinstreak see (player)");
            return;
        }
        $config = Main::$config;
        $name = $args["player"];
        if($config->exists($name)){
            $streak = $config->get($name);
            $sender->sendMessage("$name §7join streak is §c$streak §7days.");
        } else {
            $sender->sendMessage("$name §7has no join streak yet.");
        }
    }

}
