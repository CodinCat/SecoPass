#SecoPass

**SecoPass** is a very simple WordPress plugin, it can help you set up a second password easily.

![screenshot](http://i.imgur.com/bhHP7fr.png)

#How to use

1. Download and extract the [zip archive](https://github.com/MrOPR/SecoPass/archive/master.zip), rename the folder to secopass.
2. Open config.php with any text editor you like, then change the default $secopass_password (your second password).
        $secopass_password = 'Enter your second password here';
3. Upload entire **secopass** folder to wp-content/plugins/
4. That's it! Activate and works.

###Note

- This plugin is made for my single-user WordPress site, if your site has muti-user, then every user would needs to know the SecoPass you set.
- It WON'T save any data into your database. If you want to remove this plugin, you can simply delete entire secopass folder.