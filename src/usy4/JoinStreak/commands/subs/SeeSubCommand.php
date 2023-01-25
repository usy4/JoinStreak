<?php

namespace usy4\AboutMe\commands\subs;

use usy4\AboutMe\libs\CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

use usy4\AboutMe\commands\TargetPlayerArgument;
use usy4\AboutMe\Main;

class ReadSubCommand extends BaseSubCommand {

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