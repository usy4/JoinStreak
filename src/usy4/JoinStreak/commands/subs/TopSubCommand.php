<?php

namespace usy4\JoinStreak\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

use usy4\JoinStreak\Main;

class TopSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        //nothing
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        $streaks = Main::$config->get("streaks");
        arsort($streaks);
        $top_streaks = array_slice($streaks, 0, 5, true);
        $sender->sendMessage("§7Top 5 players with the highest join streaks:");
        $rank = 1;
        foreach($top_streaks as $name => $streak) {
            $sender->sendMessage("§7#$rank. §f$name: §c$streak §7days");
            $rank++;
        }
    }

}
