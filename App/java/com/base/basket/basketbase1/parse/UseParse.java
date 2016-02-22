package com.base.basket.basketbase1.parse;

import android.content.SharedPreferences;

import com.parse.Parse;
import com.parse.ParseInstallation;

public class UseParse extends android.app.Application {
    SharedPreferences firstTime;
    @Override
    public void onCreate() {
        super.onCreate();
        Parse.initialize(this, "vN625mbIaAK5u0H49DUIZyQxq7o4zMaEoG8ggnpH", "kMuJlMDkj9DU2PHq4t84lnNSK1MwtNcbqjMEczc3");
        ParseInstallation.getCurrentInstallation();

        firstTime=getSharedPreferences("Popup", 1);
    }
}