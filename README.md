Hello Fresh Test
----------------

I got in a little time deficit nearing the end, I'm not satisfied with the way the app variable needs to be transfered around to access it's data.

I was going to build a Facade structure for that, but as I said, not enought time...

You can find the configuration for the database in ```app/config/database.php``` to create the right credentials for installing it locally on your machine. There's also a file called migration.sql in the root, for the necessary tables.

There might be a problem with my logger and its read-write permissions, so make sure to ```chmod``` the ```app/storage``` directory.

I hope the code is self explanatory, most of the logic is of course in ```lib/```, all database queries will be logged to the log file.

If some commenting is still wanted, hit me up via e-mail or skype, I might still have some time tomorrow to squeeze it in between my work.