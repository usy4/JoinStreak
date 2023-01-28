<?php

declare(strict_types=1);

namespace usy4\JoinStreak;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use usy4\JoinStreak\Main;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $config = Main::$config;
        $now = time();
        $now_date = date('Y-m-d', $now);
        if($config->exists($name)){
            $streak = $config->get($name);
            $last_join_date = $config->get($name . "_last_join_date");
            $last_join_time = $config->get($name . "_last_join_time");
            $time_diff = $now - $last_join_time;
            if ($last_join_date == $now_date && $time_diff <= 300) {
                $player->sendMessage("§7Welcome back! Your join streak remains at§c" . $streak . "§7days.");
            } elseif ($last_join_date == $now_date && $time_diff > 300) {
                $config->set($name, 1);
                $player->sendMessage("§7Welcome back! But your join streak has been reset to " . "§c1" . "§7 because you did not join within the given time.");
            } else {
                $streak++;
                $config->set($name, $streak);
                $player->sendMessage("§7Welcome back! Your join streak is now§c" . $streak . "§7days.");
            }
            $config->set($name . "_last_join_date", $now_date);
            $config->set($name . "_last_join_time", $now);
            $config->save();
        } else {
            $config->set($name, 1);
            $config->set($name . "_last_join_date", date('Y-m-d', $now));
            $config->set($name . "_last_join_time", $now);
            $config->save();
            $player->sendMessage("§7Welcome to the server! This is your first time playing, so your join streak is§c" . "1" . "§7day.");
        }
    }

}
