/*** Nier: Automata ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Nier: Automata',
    'In the distant future, an extra-terrestrial force has unleashed a ruthless army known as the “machine lifeforms” on Earth, driving mankind into exile on the moon. Android 2B, one of the latest infantry models of the newly formed organization called “YoRHa,” is plunged into a bitter war to reclaim the planet. <br/><br/>NieR:Automata isn’t just a simple entertainment product; it’s a silky-smooth 60fps, open-world action RPG, sending the player through a non-stop rollercoaster of emotions.',
    'images/games/nier-ps4.jpg',
    '49.99',
    'PS4'
);
INSERT INTO game_genres values (
	3,
    'action'
);
INSERT INTO game_genres values (
	3,
    'adventure'
);
INSERT INTO game_genres values (
	3,
    'rpg'
); 



/*** Persona 5 ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Persona 5',
    'Persona 5 is a game about the internal and external conflicts of a group of troubled high school students - the protagonist and a collection of compatriots he meets in the game\'s story - who live dual lives as Phantom Thieves.<br/><br/>They have the typically ordinary day-to-day of a Tokyo high schooler - attending class, after school activities and part-time jobs. But they also undertake fantastical adventures by using otherworldly powers to enter the hearts of people. Their power comes from the Persona, the Jungian concept of the “self”.<br/><br/>The game\'s heroes realize that society forces people to wear masks to protect their inner vulnerabilities, and by literally ripping off their protective masks and confronting their inner selves do the heroes awaken their inner power, and use it to strive to help those in need.<br/><br/>Ultimately, the group of Phantom Thieves seeks to change their day-to-day world to match their perception and see through the masks modern-day society wears.',
    'images/games/persona5-ps4.jpg',
    '69.99',
    'PS4'
);
INSERT INTO game_genres values (
	4,
    'rpg'
);
INSERT INTO game_genres values (
	4,
    'strategy'
);



/*** LoZ: Breath of the Wild ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Legend of Zelda: Breath of the Wild',
	'Step into a world of discovery, exploration, and adventure in The Legend of Zelda: Breath of the Wild, a boundary-breaking new game in the acclaimed series. Travel across vast fields, through forests, and to mountain peaks as you discover what has become of the kingdom of Hyrule In this stunning Open-Air Adventure. Now on Nintendo Switch, your journey is freer and more open than ever. Take your system anywhere, and adventure as Link any way you like.',
    'images/games/lozbotw-switch',
    '79.99',
    'Nintendo Switch'
);
INSERT INTO game_genres values (
	7,
    'action'
);
INSERT INTO game_genres values (
	7,
    'adventure'
);
INSERT INTO game_genres values (
	7,
    'open-world'
);
INSERT INTO game_genres values (
	7,
    'rpg'
);



/*** Super Mario Odyssey ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Super Mario Odyssey',
	'Join Mario on a massive, globe-trotting 3D adventure and use his incredible new abilities to collect Moons so you can power up your airship, the Odyssey, and rescue Princess Peach from Bowser’s wedding plans!<br/><br/>This sandbox-style 3D Mario adventure – the first since 1997’s beloved Super Mario 64 and 2002’s Nintendo GameCube classic Super Mario Sunshine – is packed with secrets and surprises, and with Mario’s new moves like cap throw, cap jump, and capture, you’ll have fun and exciting gameplay experiences unlike anything you’ve enjoyed in a Mario game before. Get ready to be whisked away to strange and amazing places far from the Mushroom Kingdom!',
    'images/games/marioodyssey-switch',
    '79.99',
    'Nintendo Switch'
);
SELECT @curGame := game_id FROM games WHERE (name = 'Super Mario Odyssey');
INSERT INTO game_genres values (
	@curGame,
    'adventure'
);
INSERT INTO game_genres values (
	@curGame,
    'action'
);



/*** God of War ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'God of War',
	'From Santa Monica Studio and creative director Cory Barlog comes a new beginning for one of gaming’s most recognizable icons. Living as a man outside the shadow of the gods, Kratos must adapt to unfamiliar lands, unexpected threats, and a second chance at being a father. Together with his son Atreus, the pair will venture into the brutal Norse wilds and fight to fulfill a deeply personal quest.',
    'images/games/godofwar-ps4.jpg',
    '79.99',
    'PS4'
);
SELECT @curGame := game_id FROM games WHERE (name = 'God of War');
INSERT INTO game_genres values (
	@curGame,
    'action'
);
INSERT INTO game_genres values (
	@curGame,
    'adventure'
);



/*** Halo 5 ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Halo 5: Guardians',
	'A mysterious and unstoppable force threatens the galaxy, the Master Chief is missing and his loyalty questioned. Experience the most dramatic Halo story to date in a 4-player cooperative epic that spans three worlds. Challenge friends and rivals in new multiplayer modes: Warzone, massive 24-player battles, and Arena, pure 4-vs-4 competitive combat.',
    'images/games/halo5-xb1.png',
    '29.99',
    'XB1'
);
SELECT @curGame := game_id FROM games WHERE (name = 'Halo 5: Guardians');
INSERT INTO game_genres values (
	@curGame,
    'action'
);
INSERT INTO game_genres values (
	@curGame,
    'shooter'
);



/*** Forza 7 ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Forza Motorsport 7',
	'Experience the danger and beauty of competitive racing at the limit with the most comprehensive automotive game ever made.',
    'images/games/forza7-xb1.jpg',
    '49.99',
    'XB1'
);
SELECT @curGame := game_id FROM games WHERE (name = 'Forza Motorsport 7');
INSERT INTO game_genres values (
	@curGame,
    'racing'
);



/*** Sea of Thieves ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Sea of Thieves',
	'The freedom of the pirate life awaits with Sea of Thieves, an epic multiplayer adventure game in an immersive shared world. Be the pirate you want to be - with musket loaded and grog in hand, you’ll crew up with friends and set sail for epic adventures. Navigate the perils of a fantastical world and the danger of rival crews, where every sail on the horizon is another player.',
    'images/games/seaofthieves-xb1.jpg',
    '79.99',
    'XB1'
);
SELECT @curGame := game_id FROM games WHERE (name = 'Sea of Thieves');
INSERT INTO game_genres values (
	@curGame,
    'adventure'
);
INSERT INTO game_genres values (
	@curGame,
    'open-world'
);



/*** FFXIV: Stormblood ***/

INSERT INTO games (name, description, image, price, console_name) values (
	'Final Fantasy XIV: Stormblood',
	'Dive into the next chapter of the critically acclaimed game FINAL FANTASY XIV Online with its epic next expansion pack - Stormblood!<br/><br/>Explore vast, new lands, including Ala Mhigo, and challenge new Primal threats across Eorzea as you embark on hundreds of new quests as the Warrior of Light!',
    'images/games/ffxivstorm-pc.jpg',
    '79.99',
    'PC'
);
SELECT @curGame := game_id FROM games WHERE (name = 'Final Fantasy XIV: Stormblood');
INSERT INTO game_genres values (
	@curGame,
    'action'
);
INSERT INTO game_genres values (
	@curGame,
    'adventure'
);
INSERT INTO game_genres values (
	@curGame,
    'MMO'
);
INSERT INTO game_genres values (
	@curGame,
    'open-world'
);


SELECT * FROM games;

SELECT * FROM game_genres ORDER BY game_id;

SELECT * FROM genres;

SELECT * FROM consoles;

