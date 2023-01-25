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
        if($config->exists($name)){
            $streak = $config->get($name);
            $last_join = $config->get($name . "_last_join");
            $now = time();
            $date_now = date("Y-m-d", $now);
            $date_last = date("Y-m-d", $last_join);
            if($date_now === $date_last) {  // check if last join date is the same as today
                $streak++;
                $config->set($name, $streak);
                $player->sendMessage("§7Welcome back! Your join streak is now §c$streak §7days.");
            } else {
                $streak = 1;
                $config->set($name, $streak);
                $player->sendMessage("Welcome back! Your join streak has reset to §c1 §7day.");
            }
            $config->set($name . "_last_join", $now);
            $config->save();
        } else {
            $config->set($name, 1);
            $config->set($name . "_last_join", time());
            $config->save();
            $player->sendMessage("§7Welcome to the server! This is your first time playing, so your join streak is §c1 §7day.");
        }
    }

}
