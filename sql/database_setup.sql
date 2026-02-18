DROP DATABASE IF EXISTS video_games_quiz_db;
CREATE DATABASE video_games_quiz_db;
USE video_games_quiz_db;
-- ====================================================== --
-- GENRES TABLE --
-- ====================================================== --
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);
INSERT INTO genres (name)
VALUES ('Action-Adventure'),
    ('Action RPG'),
    ('Sandbox'),
    ('Platformer'),
    ('FPS'),
    ('Battle Royale'),
    ('Survival Horror'),
    ('Roguelike'),
    ('Simulation'),
    ('Social Simulation'),
    ('Racing'),
    ('Fighting'),
    ('TPS'),
    ('JRPG'),
    ('MOBA'),
    ('VR FPS'),
    ('Puzzle-Platformer'),
    ('Survival'),
    ('Metroidvania'),
    ('RPG'),
    ('Run and Gun'),
    ('Roguelite'),
    ('Deckbuilder'),
    ('Social Deduction'),
    ('Platform Battle Royale'),
    ('Sports'),
    ('Hack and Slash'),
    ('Action'),
    ('Stealth'),
    ('Immersive Sim'),
    ('Turn-based RPG'),
    ('Adventure'),
    ('Life Simulation'),
    ('City-building'),
    ('Strategy'),
    ('Grand Strategy'),
    ('Construction and Management Simulation'),
    ('MMORPG'),
    ('Puzzle'),
    ('Top-down Shooter'),
    ('Action-Platformer'),
    ('FPS/TPS'),
    ('Fishing');
-- ====================================================== --
-- PLATFORMS TABLE --
-- ====================================================== --
CREATE TABLE platforms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);
INSERT INTO platforms (name)
VALUES ('Nintendo Switch'),
    ('PlayStation 5'),
    ('PC'),
    ('PS5'),
    ('Xbox Series X/S'),
    ('PS4'),
    ('Xbox One'),
    ('Switch'),
    ('Multi-platform'),
    ('PlayStation 4'),
    ('PC (VR)'),
    ('PS3'),
    ('Xbox 360'),
    ('Xbox'),
    ('PlayStation 3'),
    ('Android');
-- ====================================================== --
-- VIDEOGAMES TABLE --
-- ====================================================== --
CREATE TABLE videoGames (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    platform_id INT,
    size_gb DECIMAL(10, 2),
    genre_id INT,
    release_year INT,
    more_data TEXT,
    average_playgame_duration INT,
    FOREIGN KEY (genre_id) REFERENCES genres(id),
    FOREIGN KEY (platform_id) REFERENCES platforms(id)
);
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'The Legend of Zelda: Breath of the Wild',
        1,
        14.4,
        1,
        2017,
        'An open-world action-adventure game developed and published by Nintendo.',
        129
    ),
    (
        'God of War Ragnarök',
        2,
        84.0,
        1,
        2022,
        'Action-adventure game developed by Santa Monica Studio and published by Sony Interactive Entertainment.',
        60
    ),
    (
        'Elden Ring',
        9,
        60.0,
        2,
        2022,
        'A fantasy action-RPG adventure set within the world created by Hidetaka Miyazaki and George R.R. Martin.',
        123
    ),
    (
        'Red Dead Redemption 2',
        9,
        150.0,
        1,
        2018,
        'Epic tale of life in America’s unforgiving heartland.',
        77
    ),
    (
        'The Witcher 3: Wild Hunt',
        9,
        35.0,
        2,
        2015,
        'Story-driven open world RPG set in a visually stunning fantasy universe.',
        65
    ),
    (
        'Cyberpunk 2077',
        9,
        70.0,
        2,
        2020,
        'Open-world, action-adventure story set in Night City.',
        137
    ),
    (
        'Grand Theft Auto V',
        9,
        72.0,
        1,
        2013,
        'Open world game set in the fictional state of San Andreas.',
        53
    ),
    (
        'Minecraft',
        9,
        1.0,
        3,
        2011,
        'Sandbox game developed by Mojang Studios.',
        128
    ),
    (
        'Super Mario Odyssey',
        1,
        5.7,
        4,
        2017,
        '3D platform game developed and published by Nintendo.',
        85
    ),
    (
        'Horizon Forbidden West',
        2,
        98.0,
        2,
        2022,
        'Sequel to Horizon Zero Dawn, following Aloy in a post-apocalyptic western United States.',
        29
    ),
    (
        'Call of Duty: Modern Warfare II',
        9,
        125.0,
        5,
        2022,
        'First-person shooter game developed by Infinity Ward.',
        113
    ),
    (
        'Overwatch 2',
        9,
        30.0,
        5,
        2022,
        'Team-based multiplayer first-person shooter.',
        110
    ),
    (
        'Fortnite',
        9,
        26.0,
        6,
        2017,
        'Free-to-play battle royale game developed by Epic Games.',
        44
    ),
    (
        'Apex Legends',
        9,
        80.0,
        6,
        2019,
        'Free-to-play battle royale-hero shooter game developed by Respawn Entertainment.',
        132
    ),
    (
        'Final Fantasy VII Remake',
        9,
        100.0,
        2,
        2020,
        'Action role-playing game developed and published by Square Enix.',
        61
    ),
    (
        'Resident Evil 4 Remake',
        9,
        67.0,
        7,
        2023,
        'Survival horror game developed and published by Capcom.',
        47
    ),
    (
        'Hogwarts Legacy',
        9,
        85.0,
        2,
        2023,
        'Immersive, open-world action RPG set in the world first introduced in the Harry Potter books.',
        124
    ),
    (
        'Spider-Man: Miles Morales',
        9,
        50.0,
        1,
        2020,
        'Action-adventure game developed by Insomniac Games.',
        134
    ),
    (
        'Ghost of Tsushima',
        9,
        60.0,
        1,
        2020,
        'Action-adventure game developed by Sucker Punch Productions.',
        4
    ),
    (
        'Demon\'s Souls',
        2,
        66.0,
        2,
        2020,
        'Remake of the classic action RPG developed by Bluepoint Games.',
        90
    ),
    (
        'Ratchet & Clank: Rift Apart',
        9,
        33.0,
        4,
        2021,
        'Third-person shooter platform game developed by Insomniac Games.',
        45
    ),
    (
        'Returnal',
        9,
        56.0,
        8,
        2021,
        'Third-person shooter roguelike video game developed by Housemarque.',
        143
    ),
    (
        'It Takes Two',
        9,
        43.0,
        1,
        2021,
        'Co-op action-adventure platformer developed by Hazelight Studios.',
        133
    ),
    (
        'Hades',
        9,
        15.0,
        8,
        2020,
        'Roguelike action dungeon crawler developed by Supergiant Games.',
        39
    ),
    (
        'Stardew Valley',
        9,
        0.5,
        9,
        2016,
        'Simulation role-playing video game developed by Eric "ConcernedApe" Barone.',
        10
    ),
    (
        'Animal Crossing: New Horizons',
        1,
        10.0,
        10,
        2020,
        'Life simulation game developed and published by Nintendo.',
        131
    ),
    (
        'Mario Kart 8 Deluxe',
        1,
        8.0,
        11,
        2017,
        'Kart racing game developed and published by Nintendo.',
        116
    ),
    (
        'Super Smash Bros. Ultimate',
        1,
        17.0,
        12,
        2018,
        'Crossover fighting game developed by Bandai Namco Studios and Sora Ltd.',
        73
    ),
    (
        'Splatoon 3',
        1,
        6.0,
        13,
        2022,
        'Third-person shooter game developed and published by Nintendo.',
        52
    ),
    (
        'Xenoblade Chronicles 3',
        1,
        14.0,
        14,
        2022,
        'Action role-playing game developed by Monolith Soft.',
        60
    ),
    (
        'Persona 5 Royal',
        9,
        41.0,
        14,
        2019,
        'Role-playing video game developed by Atlus.',
        115
    ),
    (
        'Dragon Quest XI S: Echoes of an Elusive Age',
        9,
        40.0,
        14,
        2019,
        'Role-playing video game developed by Square Enix.',
        2
    ),
    (
        'Baldur\'s Gate 3',
        9,
        150.0,
        NULL,
        2023,
        'Role-playing video game developed and published by Larian Studios.',
        68
    ),
    (
        'Diablo IV',
        9,
        90.0,
        2,
        2023,
        'Action role-playing game developed and published by Blizzard Entertainment.',
        135
    ),
    (
        'Starfield',
        9,
        125.0,
        2,
        2023,
        'Action role-playing game developed by Bethesda Game Studios.',
        64
    ),
    (
        'Forza Horizon 5',
        9,
        110.0,
        11,
        2021,
        'Racing game set in an open world environment based in Mexico.',
        61
    ),
    (
        'Halo Infinite',
        9,
        50.0,
        5,
        2021,
        'First-person shooter game developed by 343 Industries.',
        71
    ),
    (
        'Gears 5',
        9,
        80.0,
        13,
        2019,
        'Third-person shooter developed by The Coalition.',
        128
    ),
    (
        'Sea of Thieves',
        9,
        50.0,
        1,
        2018,
        'Action-adventure game developed by Rare.',
        69
    ),
    (
        'Microsoft Flight Simulator',
        9,
        150.0,
        9,
        2020,
        'Amateur flight simulator developed by Asobo Studio.',
        120
    ),
    (
        'Valorant',
        3,
        20.0,
        5,
        2020,
        'Free-to-play first-person tactical hero shooter developed by Riot Games.',
        106
    ),
    (
        'League of Legends',
        3,
        22.0,
        15,
        2009,
        'Multiplayer online battle arena video game developed by Riot Games.',
        143
    ),
    (
        'Dota 2',
        3,
        45.0,
        15,
        2013,
        'Multiplayer online battle arena video game developed by Valve.',
        135
    ),
    (
        'Counter-Strike 2',
        3,
        30.0,
        5,
        2023,
        'Multiplayer tactical first-person shooter developed by Valve.',
        134
    ),
    (
        'Team Fortress 2',
        3,
        24.0,
        5,
        2007,
        'Multiplayer first-person shooter game developed by Valve.',
        121
    ),
    (
        'Half-Life: Alyx',
        11,
        68.0,
        16,
        2020,
        'Virtual reality first-person shooter developed by Valve.',
        16
    ),
    (
        'Portal 2',
        9,
        12.0,
        17,
        2011,
        'Puzzle-platform game developed by Valve.',
        136
    ),
    (
        'Left 4 Dead 2',
        9,
        14.0,
        5,
        2009,
        'Cooperative first-person shooter developed by Valve.',
        67
    ),
    (
        'Rust',
        9,
        25.0,
        18,
        2013,
        'Multiplayer-only survival video game developed by Facepunch Studios.',
        145
    ),
    (
        'Ark: Survival Evolved',
        9,
        100.0,
        18,
        2017,
        'Action-adventure survival video game developed by Studio Wildcard.',
        72
    ),
    (
        'Valheim',
        9,
        2.0,
        18,
        2021,
        'Survival and sandbox video game developed by Iron Gate Studio.',
        105
    ),
    (
        'Terraria',
        9,
        0.5,
        3,
        2011,
        'Action-adventure sandbox game developed by Re-Logic.',
        77
    ),
    (
        'Hollow Knight',
        9,
        9.0,
        19,
        2017,
        'Metroidvania video game developed and published by Team Cherry.',
        99
    ),
    (
        'Celeste',
        9,
        1.2,
        4,
        2018,
        'Platforming video game developed by Maddy Makes Games.',
        51
    ),
    (
        'Undertale',
        9,
        0.3,
        20,
        2015,
        'Role-playing video game created by indie developer Toby Fox.',
        64
    ),
    (
        'Cuphead',
        9,
        4.0,
        21,
        2017,
        'Run and gun video game developed and published by Studio MDHR.',
        127
    ),
    (
        'Dead Cells',
        9,
        1.5,
        22,
        2018,
        'Roguelite-metroidvania hybrid developed by Motion Twin.',
        126
    ),
    (
        'Slay the Spire',
        9,
        1.0,
        23,
        2019,
        'Roguelike deck-building video game developed by Mega Crit.',
        61
    ),
    (
        'Among Us',
        9,
        0.5,
        24,
        2018,
        'Online multiplayer social deduction game developed by Innersloth.',
        22
    ),
    (
        'Fall Guys',
        9,
        4.0,
        25,
        2020,
        'Platform battle royale game developed by Mediatonic.',
        127
    ),
    (
        'Rocket League',
        9,
        20.0,
        26,
        2015,
        'Vehicular soccer video game developed by Psyonix.',
        30
    ),
    (
        'FIFA 23',
        9,
        50.0,
        26,
        2022,
        'Football simulation video game published by Electronic Arts.',
        88
    ),
    (
        'NBA 2K23',
        9,
        110.0,
        26,
        2022,
        'Basketball simulation video game developed by Visual Concepts.',
        131
    ),
    (
        'Madden NFL 23',
        9,
        50.0,
        26,
        2022,
        'American football video game based on the National Football League.',
        88
    ),
    (
        'Gran Turismo 7',
        9,
        110.0,
        11,
        2022,
        'Racing simulation video game developed by Polyphony Digital.',
        108
    ),
    (
        'F1 23',
        9,
        50.0,
        11,
        2023,
        'Racing video game developed by Codemasters.',
        40
    ),
    (
        'Street Fighter 6',
        9,
        60.0,
        12,
        2023,
        'Fighting game developed and published by Capcom.',
        9
    ),
    (
        'Tekken 8',
        9,
        80.0,
        12,
        2024,
        'Fighting game developed by Bandai Namco Studios and Arika.',
        146
    ),
    (
        'Mortal Kombat 1',
        9,
        100.0,
        12,
        2023,
        'Fighting game developed by NetherRealm Studios.',
        17
    ),
    (
        'Guilty Gear Strive',
        9,
        20.0,
        12,
        2021,
        'Fighting video game developed and published by Arc System Works.',
        125
    ),
    (
        'Monster Hunter: World',
        9,
        50.0,
        2,
        2018,
        'Action role-playing game developed and published by Capcom.',
        136
    ),
    (
        'Monster Hunter Rise',
        9,
        25.0,
        2,
        2021,
        'Action role-playing game developed and published by Capcom.',
        73
    ),
    (
        'Dark Souls III',
        9,
        25.0,
        2,
        2016,
        'Action role-playing game developed by FromSoftware.',
        96
    ),
    (
        'Bloodborne',
        10,
        36.0,
        2,
        2015,
        'Action role-playing game developed by FromSoftware.',
        58
    ),
    (
        'Sekiro: Shadows Die Twice',
        9,
        25.0,
        1,
        2019,
        'Action-adventure game developed by FromSoftware.',
        50
    ),
    (
        'Nier: Automata',
        9,
        50.0,
        2,
        2017,
        'Action role-playing game developed by PlatinumGames.',
        22
    ),
    (
        'Bayonetta 3',
        1,
        15.0,
        27,
        2022,
        'Action-adventure game developed by PlatinumGames.',
        36
    ),
    (
        'Devil May Cry 5',
        9,
        35.0,
        27,
        2019,
        'Action-adventure game developed and published by Capcom.',
        75
    ),
    (
        'Resident Evil Village',
        9,
        28.0,
        7,
        2021,
        'Survival horror game developed and published by Capcom.',
        76
    ),
    (
        'Silent Hill 2 Remake',
        9,
        50.0,
        7,
        2024,
        'Survival horror game developed by Bloober Team.',
        83
    ),
    (
        'Alan Wake 2',
        9,
        90.0,
        7,
        2023,
        'Survival horror game developed by Remedy Entertainment.',
        100
    ),
    (
        'Control',
        9,
        42.0,
        1,
        2019,
        'Action-adventure game developed by Remedy Entertainment.',
        34
    ),
    (
        'Death Stranding',
        9,
        80.0,
        28,
        2019,
        'Action game developed by Kojima Productions.',
        12
    ),
    (
        'Metal Gear Solid V: The Phantom Pain',
        9,
        28.0,
        29,
        2015,
        'Stealth game developed by Kojima Productions.',
        78
    ),
    (
        'Hitman 3',
        9,
        60.0,
        29,
        2021,
        'Stealth game developed by IO Interactive.',
        111
    ),
    (
        'Dishonored 2',
        9,
        60.0,
        29,
        2016,
        'Action-adventure game developed by Arkane Studios.',
        118
    ),
    (
        'Prey',
        9,
        40.0,
        30,
        2017,
        'First-person shooter developed by Arkane Austin.',
        93
    ),
    (
        'BioShock Infinite',
        9,
        20.0,
        5,
        2013,
        'First-person shooter developed by Irrational Games.',
        147
    ),
    (
        'Mass Effect Legendary Edition',
        9,
        120.0,
        2,
        2021,
        'Compilation of the video games in the Mass Effect trilogy.',
        29
    ),
    (
        'Fallout 4',
        9,
        30.0,
        2,
        2015,
        'Action role-playing game developed by Bethesda Game Studios.',
        133
    ),
    (
        'Skyrim: Special Edition',
        9,
        12.0,
        2,
        2016,
        'Action role-playing game developed by Bethesda Game Studios.',
        42
    ),
    (
        'Kingdom Hearts III',
        9,
        40.0,
        2,
        2019,
        'Action role-playing game developed and published by Square Enix.',
        95
    ),
    (
        'Final Fantasy XVI',
        2,
        90.0,
        2,
        2023,
        'Action role-playing game developed and published by Square Enix.',
        101
    ),
    (
        'Tales of Arise',
        9,
        45.0,
        14,
        2021,
        'Action role-playing game developed and published by Bandai Namco Entertainment.',
        59
    ),
    (
        'Yakuza: Like a Dragon',
        9,
        50.0,
        14,
        2020,
        'Role-playing video game developed by Ryu Ga Gotoku Studio.',
        139
    ),
    (
        'Judgment',
        9,
        40.0,
        1,
        2018,
        'Action-adventure game developed by Ryu Ga Gotoku Studio.',
        38
    ),
    (
        'Lost Judgment',
        9,
        60.0,
        1,
        2021,
        'Sequel to the 2018 game Judgment.',
        136
    ),
    (
        'Genshin Impact',
        9,
        70.0,
        2,
        2020,
        'Action role-playing game developed by miHoYo.',
        102
    ),
    (
        'Honkai: Star Rail',
        9,
        30.0,
        31,
        2023,
        'Role-playing video game developed by miHoYo.',
        124
    ),
    (
        'Destiny 2',
        9,
        105.0,
        5,
        2017,
        'Free-to-play online-only multiplayer first-person shooter developed by Bungie.',
        129
    );
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'The Last of Us Part I',
        9,
        80.0,
        1,
        2022,
        'Action-adventure game developed by Naughty Dog.',
        135
    ),
    (
        'The Last of Us Part II',
        9,
        100.0,
        1,
        2020,
        'Action-adventure game developed by Naughty Dog.',
        88
    ),
    (
        'Uncharted 4: A Thief''s End',
        9,
        50.0,
        1,
        2016,
        'Action-adventure game developed by Naughty Dog.',
        122
    ),
    (
        'Detroit: Become Human',
        9,
        45.0,
        32,
        2018,
        'Adventure game developed by Quantic Dream.',
        117
    ),
    (
        'Heavy Rain',
        9,
        15.0,
        32,
        2010,
        'Interactive drama action-adventure video game developed by Quantic Dream.',
        90
    ),
    (
        'Beyond: Two Souls',
        9,
        25.0,
        32,
        2013,
        'Interactive drama action-adventure video game developed by Quantic Dream.',
        70
    ),
    (
        'Life is Strange',
        9,
        14.0,
        32,
        2015,
        'Episodic graphic adventure video game developed by Dontnod Entertainment.',
        116
    ),
    (
        'The Sims 4',
        9,
        20.0,
        33,
        2014,
        'Life simulation game developed by Maxis and published by Electronic Arts.',
        131
    ),
    (
        'Cities: Skylines',
        9,
        12.0,
        34,
        2015,
        'City-building game developed by Colossal Order.',
        16
    ),
    (
        'Planet Zoo',
        9,
        16.0,
        9,
        2019,
        'Construction and management simulation video game developed by Frontier Developments.',
        81
    ),
    (
        'Total War: Warhammer III',
        3,
        120.0,
        35,
        2022,
        'Turn-based strategy and real-time tactics video game developed by Creative Assembly.',
        127
    ),
    (
        'Crusader Kings III',
        9,
        8.0,
        36,
        2020,
        'Grand strategy role-playing video game developed by Paradox Development Studio.',
        35
    ),
    (
        'Europa Universalis IV',
        3,
        6.0,
        36,
        2013,
        'Grand strategy wargame developed by Paradox Development Studio.',
        56
    ),
    (
        'Hearts of Iron IV',
        3,
        2.0,
        36,
        2016,
        'Grand strategy computer wargame developed by Paradox Development Studio.',
        22
    ),
    (
        'Stellaris',
        9,
        10.0,
        36,
        2016,
        '4X grand strategy video game developed by Paradox Development Studio.',
        24
    ),
    (
        'RimWorld',
        9,
        1.0,
        37,
        2018,
        'Construction and management simulation created by Ludeon Studios.',
        74
    ),
    (
        'Factorio',
        9,
        3.0,
        37,
        2020,
        'Construction and management simulation game developed by Wube Software.',
        69
    ),
    (
        'Satisfactory',
        3,
        15.0,
        9,
        2020,
        'First-person open-world factory building game developed by Coffee Stain Studios.',
        44
    ),
    (
        'Deep Rock Galactic',
        9,
        3.0,
        5,
        2020,
        'Cooperative first-person shooter video game developed by Ghost Ship Games.',
        46
    ),
    (
        'Payday 2',
        9,
        83.0,
        5,
        2013,
        'Cooperative first-person shooter video game developed by Overkill Software.',
        131
    ),
    (
        'Warframe',
        9,
        35.0,
        13,
        2013,
        'Free-to-play action role-playing third-person shooter multiplayer online game developed by Digital Extremes.',
        67
    ),
    (
        'World of Warcraft',
        3,
        100.0,
        38,
        2004,
        'Massively multiplayer online role-playing game released by Blizzard Entertainment.',
        14
    ),
    (
        'Final Fantasy XIV',
        9,
        80.0,
        38,
        2013,
        'Massively multiplayer online role-playing game developed and published by Square Enix.',
        87
    ),
    (
        'The Elder Scrolls Online',
        9,
        95.0,
        38,
        2014,
        'Massively multiplayer online role-playing game developed by ZeniMax Online Studios.',
        43
    ),
    (
        'Guild Wars 2',
        3,
        55.0,
        38,
        2012,
        'Massively multiplayer online role-playing game developed by ArenaNet.',
        51
    ),
    (
        'Black Desert Online',
        9,
        50.0,
        38,
        2015,
        'Sandbox-oriented massively multiplayer online role-playing game by Korean video game developer Pearl Abyss.',
        142
    ),
    (
        'Lost Ark',
        3,
        70.0,
        38,
        2019,
        'Top-down 2.5D massive multiplayer online action role-playing game co-developed by Tripod Studio and Smilegate RPG.',
        143
    ),
    (
        'Path of Exile',
        9,
        40.0,
        2,
        2013,
        'Free-to-play action role-playing video game developed and published by Grinding Gear Games.',
        137
    ),
    (
        'Smite',
        9,
        30.0,
        15,
        2014,
        'Free-to-play, third-person multiplayer online battle arena video game developed and published by Hi-Rez Studios.',
        71
    ),
    (
        'Paladins',
        9,
        30.0,
        5,
        2018,
        'Free-to-play online hero shooter video game by Hi-Rez Studios.',
        52
    ),
    (
        'Realm Royale',
        9,
        15.0,
        6,
        2018,
        'Free-to-play battle royale game developed by Heroic Leap Games.',
        2
    ),
    (
        'PUBG: Battlegrounds',
        9,
        40.0,
        6,
        2017,
        'Online multiplayer battle royale game developed and published by PUBG Corporation.',
        142
    ),
    (
        'DayZ',
        9,
        25.0,
        18,
        2018,
        'Survival video game developed and published by Bohemia Interactive.',
        26
    ),
    (
        'SCUM',
        3,
        70.0,
        18,
        2018,
        'Multiplayer online survival game, developed by Croatian studio Gamepires.',
        46
    ),
    (
        '7 Days to Die',
        9,
        12.0,
        7,
        2013,
        'Survival horror video game set in an open world developed by The Fun Pimps.',
        133
    ),
    (
        'The Forest',
        9,
        5.0,
        7,
        2018,
        'Survival horror video game developed and published by Endnight Games.',
        8
    ),
    (
        'Sons of the Forest',
        3,
        20.0,
        7,
        2023,
        'Survival horror video game developed by Endnight Games and published by Newnight.',
        70
    ),
    (
        'Green Hell',
        9,
        8.0,
        18,
        2019,
        'Survival simulator set in an uncharted Amazonian rainforest developed by Creepy Jar.',
        58
    ),
    (
        'Stranded Deep',
        9,
        4.0,
        18,
        2015,
        'Survival video game developed by Australian studio Beam Team Games.',
        117
    ),
    (
        'Raft',
        3,
        10.0,
        18,
        2018,
        'Open world survival video game developed by Redbeet Interactive.',
        98
    ),
    (
        'Tunic',
        9,
        3.0,
        1,
        2022,
        'Action-adventure game developed by Andrew Shouldice.',
        25
    ),
    (
        'Cult of the Lamb',
        9,
        4.0,
        8,
        2022,
        'Roguelike video game developed by indie developer Massive Monster.',
        73
    ),
    (
        'Inscryption',
        9,
        3.0,
        23,
        2021,
        'Deck-building game developed by Daniel Mullins Games.',
        107
    ),
    (
        'Loop Hero',
        9,
        0.5,
        8,
        2021,
        'Endless RPG developed by Russian studio Four Quarters.',
        93
    ),
    (
        'Return of the Obra Dinn',
        9,
        2.0,
        39,
        2018,
        'Puzzle video game created by Lucas Pope.',
        111
    ),
    (
        'Papers, Please',
        9,
        0.1,
        39,
        2013,
        'Puzzle simulation video game created by indie developer Lucas Pope.',
        140
    ),
    (
        'Hotline Miami',
        9,
        0.6,
        40,
        2012,
        'Top-down shooter video game by Dennaton Games.',
        13
    ),
    (
        'Katana Zero',
        9,
        0.4,
        41,
        2019,
        '2D action platform video game developed by Askiisoft.',
        143
    ),
    (
        'Gris',
        9,
        4.0,
        4,
        2018,
        'Platform-adventure game by Spanish developer Nomada Studio.',
        137
    ),
    (
        'Journey',
        9,
        4.0,
        32,
        2012,
        'Indie adventure game developed by Thatgamecompany.',
        37
    ),
    (
        'Abzû',
        9,
        5.0,
        32,
        2016,
        'Adventure video game developed by Giant Squid Studios.',
        131
    ),
    (
        'Firewatch',
        9,
        4.0,
        32,
        2016,
        'Adventure game developed by Campo Santo.',
        53
    ),
    (
        'What Remains of Edith Finch',
        9,
        5.0,
        32,
        2017,
        'Adventure game developed by Giant Sparrow.',
        43
    ),
    (
        'Outer Wilds',
        9,
        10.0,
        1,
        2019,
        'Action-adventure game developed by Mobius Digital.',
        47
    ),
    (
        'The Stanley Parable: Ultra Deluxe',
        9,
        5.0,
        32,
        2022,
        'Interactive drama and walking simulator designed by Davey Wreden.',
        104
    ),
    (
        'Super Meat Boy',
        9,
        0.4,
        4,
        2010,
        'Platform game designed by Edmund McMillen and Tommy Refenes.',
        54
    ),
    (
        'The Binding of Isaac: Rebirth',
        9,
        1.0,
        8,
        2014,
        'Indie roguelike video game designed by Edmund McMillen.',
        21
    ),
    (
        'Spelunky 2',
        9,
        1.0,
        4,
        2020,
        'Platform game developed by Mossmouth and BlitWorks.',
        146
    ),
    (
        'Don''t Starve Together',
        9,
        3.0,
        18,
        2016,
        'Multiplayer expansion of the uncompromising wilderness survival game Don''t Starve.',
        75
    ),
    (
        'Oxygen Not Included',
        3,
        3.0,
        9,
        2019,
        'Survival simulation video game developed and published by Klei Entertainment.',
        92
    ),
    (
        'Kenshi',
        3,
        14.0,
        20,
        2018,
        'Role-playing video game developed and published by Lo-Fi Games.',
        70
    ),
    (
        'Mount & Blade II: Bannerlord',
        9,
        60.0,
        2,
        2022,
        'Strategy action role-playing video game developed by TaleWorlds Entertainment.',
        95
    ),
    (
        'Chivalry 2',
        9,
        20.0,
        27,
        2021,
        'Multiplayer hack and slash action video game developed by Torn Banner Studios.',
        20
    ),
    (
        'Mordhau',
        9,
        20.0,
        27,
        2019,
        'Multiplayer medieval hack and slash video game developed by Triternion.',
        141
    ),
    (
        'For Honor',
        9,
        90.0,
        12,
        2017,
        'Action fighting game developed and published by Ubisoft.',
        75
    ),
    (
        'Kingdom Come: Deliverance',
        9,
        70.0,
        2,
        2018,
        'Action role-playing video game developed by Warhorse Studios.',
        81
    ),
    (
        'Far Cry 6',
        9,
        60.0,
        5,
        2021,
        'First-person shooter game developed by Ubisoft Toronto.',
        62
    ),
    (
        'Far Cry 5',
        9,
        40.0,
        5,
        2018,
        'First-person shooter game developed by Ubisoft Montreal and Ubisoft Toronto.',
        80
    ),
    (
        'Far Cry 3',
        9,
        15.0,
        5,
        2012,
        'First-person shooter developed by Ubisoft Montreal.',
        119
    ),
    (
        'Assassin''s Creed Valhalla',
        9,
        130.0,
        2,
        2020,
        'Action role-playing video game developed by Ubisoft Montreal.',
        56
    ),
    (
        'Assassin''s Creed Odyssey',
        9,
        110.0,
        2,
        2018,
        'Action role-playing video game developed by Ubisoft Quebec.',
        141
    ),
    (
        'Assassin''s Creed Origins',
        9,
        75.0,
        2,
        2017,
        'Action role-playing video game developed by Ubisoft Montreal.',
        67
    ),
    (
        'Watch Dogs: Legion',
        9,
        90.0,
        1,
        2020,
        'Action-adventure game developed by Ubisoft Toronto.',
        142
    ),
    (
        'Tom Clancy''s Rainbow Six Siege',
        9,
        85.0,
        5,
        2015,
        'Online tactical shooter video game developed by Ubisoft Montreal.',
        58
    ),
    (
        'Tom Clancy''s The Division 2',
        9,
        110.0,
        13,
        2019,
        'Online-only action role-playing video game developed by Massive Entertainment.',
        59
    ),
    (
        'Tom Clancy''s Ghost Recon Breakpoint',
        9,
        80.0,
        13,
        2019,
        'Online tactical shooter video game developed by Ubisoft Paris.',
        52
    ),
    (
        'Just Cause 4',
        9,
        59.0,
        1,
        2018,
        'Action-adventure game developed by Avalanche Studios.',
        90
    ),
    (
        'Saints Row',
        9,
        50.0,
        1,
        2022,
        'Action-adventure game developed by Volition.',
        84
    ),
    (
        'Mafia: Definitive Edition',
        9,
        50.0,
        1,
        2020,
        'Action-adventure video game developed by Hangar 13.',
        102
    ),
    (
        'L.A. Noire',
        9,
        30.0,
        1,
        2011,
        'Neo-noir detective action-adventure video game developed by Team Bondi.',
        58
    ),
    (
        'Sleeping Dogs',
        9,
        20.0,
        1,
        2012,
        'Action-adventure video game developed by United Front Games.',
        137
    ),
    (
        'Max Payne 3',
        9,
        35.0,
        13,
        2012,
        'Third-person shooter video game developed by Rockstar Studios.',
        79
    ),
    (
        'Quantum Break',
        9,
        68.0,
        1,
        2016,
        'Science fiction action-adventure third-person shooter video game developed by Remedy Entertainment.',
        110
    ),
    (
        'Star Wars Jedi: Survivor',
        9,
        155.0,
        1,
        2023,
        'Action-adventure game developed by Respawn Entertainment.',
        108
    ),
    (
        'Star Wars Jedi: Fallen Order',
        9,
        55.0,
        1,
        2019,
        'Action-adventure game developed by Respawn Entertainment.',
        99
    ),
    (
        'Star Wars Battlefront II',
        9,
        90.0,
        42,
        2017,
        'Action shooter video game based on the Star Wars franchise.',
        148
    ),
    (
        'Lego Star Wars: The Skywalker Saga',
        9,
        40.0,
        1,
        2022,
        'Lego-themed action-adventure game developed by Traveller''s Tales.',
        149
    ),
    (
        'Marvel''s Guardians of the Galaxy',
        9,
        80.0,
        1,
        2021,
        'Action-adventure video game developed by Eidos-Montréal.',
        72
    ),
    (
        'Marvel''s Avengers',
        9,
        100.0,
        1,
        2020,
        'Action-adventure video game developed by Crystal Dynamics.',
        17
    ),
    (
        'Batman: Arkham Knight',
        9,
        55.0,
        1,
        2015,
        'Action-adventure game developed by Rocksteady Studios.',
        43
    ),
    (
        'Batman: Arkham City',
        9,
        20.0,
        1,
        2011,
        'Action-adventure game developed by Rocksteady Studios.',
        9
    ),
    (
        'Batman: Arkham Asylum',
        9,
        10.0,
        1,
        2009,
        'Action-adventure game developed by Rocksteady Studios.',
        56
    ),
    (
        'Suicide Squad: Kill the Justice League',
        9,
        65.0,
        1,
        2024,
        'Action-adventure game developed by Rocksteady Studios.',
        115
    ),
    (
        'Dredge',
        9,
        2.0,
        43,
        2023,
        'Sinister fishing adventure developed by Black Salt Games.',
        43
    ),
    (
        'Forspoken',
        9,
        150.0,
        2,
        2023,
        'Action role-playing video game developed by Luminous Productions.',
        23
    ),
    (
        'Immortals of Aveum',
        9,
        70.0,
        5,
        2023,
        'First-person shooter game developed by Ascendant Studios.',
        15
    ),
    (
        'Remnant 2',
        9,
        80.0,
        13,
        2023,
        'Third-person shooter action role-playing video game developed by Gunfire Games.',
        121
    ),
    (
        'Lies of P',
        9,
        50.0,
        2,
        2023,
        'Action role-playing video game developed by Neowiz Games and Round8 Studio.',
        20
    ),
    (
        'Lords of the Fallen',
        9,
        60.0,
        2,
        2023,
        'Action role-playing video game developed by Hexworks.',
        132
    ),
    (
        'Armored Core VI: Fires of Rubicon',
        9,
        60.0,
        28,
        2023,
        'Mecha-based vehicular combat game developed by FromSoftware.',
        139
    );
-- ====================================================== --
-- USERS TABLE --
-- ====================================================== --
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    device VARCHAR(100),
    available_time_minutes INT,
    mood VARCHAR(100),
    recommended_game_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recommended_game_id) REFERENCES videoGames(id)
);
-- NEW GAMES BATCH 1 --
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'Candy Crush Saga',
        16,
        0.3,
        47,
        2012,
        'Legendary puzzle game loved by millions.',
        15
    ),
    (
        'Clash of Clans',
        16,
        0.5,
        43,
        2012,
        'Build your village, raise a clan, and compete in epic Clan Wars.',
        145
    ),
    (
        'PUBG Mobile',
        16,
        2.5,
        6,
        2018,
        'The original battle royale on mobile.',
        35
    ),
    (
        'Genshin Impact',
        16,
        25.0,
        2,
        2020,
        'Open-world action RPG with anime style.',
        150
    ),
    (
        'Call of Duty: Mobile',
        16,
        5.0,
        5,
        2019,
        'Console quality HD gaming on your phone.',
        45
    ),
    (
        'Pokémon GO',
        16,
        0.4,
        47,
        2016,
        'Join Trainers across the globe who are discovering Pokémon.',
        90
    ),
    (
        'Roblox',
        16,
        0.3,
        3,
        2006,
        'Global platform where millions of people gather together to imagine, create, and share experiences.',
        60
    ),
    (
        'Subway Surfers',
        16,
        0.2,
        49,
        2012,
        'Dash as fast as you can!',
        10
    ),
    (
        'Minecraft',
        16,
        1.0,
        3,
        2011,
        'Explore infinite worlds and build everything from the simplest of homes to the grandest of castles.',
        120
    ),
    (
        'Among Us',
        16,
        0.5,
        24,
        2018,
        'An online and local party game of teamwork and betrayal.',
        20
    ),
    (
        'Clash Royale',
        16,
        0.4,
        43,
        2016,
        'Real-time multiplayer game starring the Royales.',
        25
    ),
    (
        'Brawl Stars',
        16,
        0.6,
        15,
        2018,
        'Fast-paced 3v3 multiplayer and battle royale.',
        15
    ),
    (
        'Mobile Legends: Bang Bang',
        16,
        4.0,
        15,
        2016,
        'Join your friends in a brand new 5v5 MOBA showdown.',
        30
    ),
    (
        'Asphalt 9: Legends',
        16,
        3.0,
        11,
        2018,
        'Tear up the asphalt and take on the world\'s best fearless street racer pros.',
        12
    ),
    (
        'Shadow Fight 3',
        16,
        1.5,
        12,
        2017,
        'Epic fighting RPG game.',
        40
    ),
    (
        'Monument Valley',
        16,
        0.3,
        47,
        2014,
        'Surreal exploration through fantastical architecture.',
        4
    ),
    (
        'Alto\'s Odyssey',
        16,
        0.2,
        49,
        2018,
        'Endless sandboarding journey.',
        15
    ),
    (
        'Stardew Valley',
        16,
        0.5,
        9,
        2016,
        'Farming RPG.',
        80
    ),
    (
        'Terraria',
        16,
        0.3,
        3,
        2011,
        'Dig, Fight, Explore, Build.',
        90
    ),
    (
        'Dead Cells',
        16,
        1.8,
        22,
        2018,
        'Roguevania action-platformer.',
        50
    ),
    (
        'Slay the Spire',
        16,
        1.0,
        23,
        2019,
        'Roguelike deckbuilder.',
        60
    ),
    (
        'Hearthstone',
        16,
        4.0,
        23,
        2014,
        'Strategy card game.',
        45
    ),
    (
        'Legends of Runeterra',
        16,
        2.0,
        23,
        2020,
        'Strategy card game set in the world of League of Legends.',
        35
    ),
    (
        'Marvel Snap',
        16,
        0.5,
        23,
        2022,
        'Fast-paced card battler.',
        15
    ),
    (
        'Diablo Immortal',
        16,
        12.0,
        2,
        2022,
        'Mobile MMO Action RPG.',
        70
    ),
    (
        'Final Fantasy VII: Ever Crisis',
        16,
        5.0,
        20,
        2023,
        'Another possibility for a remake.',
        55
    ),
    (
        'Honkai Impact 3rd',
        16,
        15.0,
        35,
        2016,
        'Anime action RPG.',
        100
    ),
    (
        'Arknights',
        16,
        4.0,
        43,
        2019,
        'Tower defense RPG.',
        85
    ),
    (
        'Fate/Grand Order',
        16,
        3.0,
        20,
        2015,
        'Command spirits and save humanity.',
        150
    ),
    (
        'Azur Lane',
        16,
        5.0,
        40,
        2017,
        'Naval warfare side-scroller.',
        65
    ),
    (
        'Blue Archive',
        16,
        4.0,
        20,
        2021,
        'Youth x Academy x Military RPG.',
        50
    ),
    (
        'Nikke: Goddess of Victory',
        16,
        4.5,
        21,
        2022,
        'Sci-fi RPG shooter.',
        40
    ),
    (
        'Summoners War',
        16,
        3.0,
        31,
        2014,
        'Fantasy RPG.',
        120
    ),
    (
        'Raid: Shadow Legends',
        16,
        2.0,
        31,
        2018,
        'Turn-based RPG.',
        90
    ),
    (
        'AFK Arena',
        16,
        1.0,
        31,
        2019,
        'Casual idle RPG.',
        30
    ),
    (
        'Temple Run 2',
        16,
        0.2,
        49,
        2013,
        'Infinite runner.',
        8
    ),
    (
        'Jetpack Joyride',
        16,
        0.1,
        49,
        2011,
        'Bullet-powered jetpacks.',
        10
    ),
    (
        'Fruit Ninja',
        16,
        0.2,
        36,
        2010,
        'Slice fruit, don\'t slice bombs.',
        5
    ),
    (
        'Plants vs. Zombies 2',
        16,
        0.8,
        43,
        2013,
        'Defend your brain.',
        25
    ),
    (
        'Angry Birds 2',
        16,
        0.4,
        47,
        2015,
        'The birds are back.',
        15
    ),
    (
        'Cut the Rope',
        16,
        0.1,
        47,
        2010,
        'Feed candy to Om Nom.',
        6
    ),
    (
        'Hill Climb Racing',
        16,
        0.2,
        11,
        2012,
        'Physics based driving game.',
        12
    ),
    (
        'Real Racing 3',
        16,
        3.5,
        11,
        2013,
        'Award-winning franchise.',
        20
    ),
    (
        'Need for Speed: No Limits',
        16,
        2.5,
        11,
        2015,
        'Race for dominance.',
        18
    ),
    (
        'Mario Kart Tour',
        16,
        1.5,
        11,
        2019,
        'Mario Kart endless fun.',
        10
    ),
    (
        'Fire Emblem Heroes',
        16,
        1.0,
        43,
        2017,
        'Strategy RPG.',
        60
    ),
    (
        'Dragalia Lost',
        16,
        3.0,
        2,
        2018,
        'Action RPG.',
        75
    ),
    (
        'Animal Crossing: Pocket Camp',
        16,
        0.8,
        10,
        2017,
        'Relaxing camp manager.',
        45
    ),
    (
        'Dr. Mario World',
        16,
        0.5,
        47,
        2019,
        'Puzzle game.',
        8
    ),
    (
        'Harry Potter: Wizards Unite',
        16,
        1.0,
        47,
        2019,
        'Augmented reality game.',
        20
    ),
    (
        'Ingress Prime',
        16,
        0.5,
        47,
        2013,
        'The world is the game.',
        50
    ),
    (
        'Pikmin Bloom',
        16,
        0.4,
        47,
        2021,
        'Walk to grow Pikmin.',
        15
    ),
    (
        'Monster Hunter Now',
        16,
        1.0,
        2,
        2023,
        'Hunt monsters in the real world.',
        30
    ),
    (
        'Peridot',
        16,
        0.5,
        10,
        2023,
        'Virtual pets.',
        10
    ),
    (
        'Sky: Children of the Light',
        16,
        2.0,
        40,
        2019,
        'Social adventure game.',
        30
    ),
    (
        'Journey',
        16,
        1.0,
        32,
        2013,
        'Indie darling.',
        5
    ),
    (
        'Flower',
        16,
        0.8,
        32,
        2009,
        'Control the wind.',
        3
    ),
    (
        'Florence',
        16,
        0.3,
        32,
        2018,
        'Iteractive story.',
        2
    ),
    (
        'Gorogoa',
        16,
        0.6,
        47,
        2017,
        'Beautiful puzzle game.',
        4
    ),
    (
        'Donut County',
        16,
        0.5,
        47,
        2018,
        'Physics puzzle game.',
        3
    ),
    (
        'The Room',
        16,
        0.4,
        47,
        2012,
        'Physical puzzler.',
        5
    ),
    (
        'The Room Two',
        16,
        0.5,
        47,
        2013,
        'More puzzles.',
        6
    ),
    (
        'The Room Three',
        16,
        0.8,
        47,
        2015,
        'Even more puzzles.',
        8
    ),
    (
        'The Room: Old Sins',
        16,
        1.0,
        47,
        2018,
        'Haunted dollhouse puzzles.',
        9
    ),
    (
        'Limbo',
        16,
        0.2,
        17,
        2010,
        'Dark puzzle platformer.',
        6
    ),
    (
        'Inside',
        16,
        1.5,
        17,
        2016,
        'Atmospheric puzzle platformer.',
        5
    ),
    (
        'Little Nightmares',
        16,
        2.0,
        17,
        2019,
        'Dark whimsical tale.',
        7
    ),
    (
        'Very Little Nightmares',
        16,
        0.8,
        47,
        2019,
        'Prequel puzzle adventure.',
        6
    ),
    (
        'Life in Adventure',
        16,
        0.2,
        40,
        2021,
        'Text-based adventure.',
        8
    ),
    (
        '80 Days',
        16,
        0.2,
        40,
        2014,
        'Steampunk adventure.',
        10
    ),
    (
        'Sorcery!',
        16,
        0.3,
        20,
        2013,
        'Interactive gamebook.',
        12
    ),
    ('Reigns', 16, 0.1, 36, 2016, 'Swipe to rule.', 4),
    (
        'Reigns: Her Majesty',
        16,
        0.1,
        43,
        2017,
        'Swipe to queen.',
        4
    ),
    (
        'Reigns: Game of Thrones',
        16,
        0.1,
        43,
        2018,
        'Winter is swiping.',
        5
    ),
    (
        'Downwell',
        16,
        0.1,
        41,
        2015,
        'Roguelike vertical shooter.',
        10
    ),
    (
        'Grid Autosport',
        16,
        4.0,
        11,
        2019,
        'Console quality racing.',
        25
    ),
    (
        'XCOM 2 Collection',
        16,
        8.0,
        43,
        2020,
        'Tactical alien fighting.',
        60
    ),
    (
        'Civilization VI',
        16,
        6.0,
        43,
        2020,
        'Build an empire.',
        100
    ),
    (
        'Tropico',
        16,
        2.5,
        45,
        2019,
        'Dictator simulator.',
        40
    ),
    (
        'Company of Heroes',
        16,
        4.0,
        43,
        2020,
        'WWII RTS.',
        30
    ),
    (
        'Total War: Medieval II',
        16,
        4.5,
        43,
        2022,
        'Epic battles.',
        50
    ),
    (
        'Alien: Isolation',
        16,
        11.0,
        7,
        2021,
        'Survival horror masterpiece.',
        20
    ),
    (
        'Streets of Rage 4',
        16,
        1.5,
        35,
        2022,
        'Classic beat em up.',
        12
    ),
    (
        'TMNT: Shredder\'s Revenge',
        16,
        1.0,
        35,
        2023,
        'Cowabunga!',
        10
    ),
    (
        'Vampire Survivors',
        16,
        0.5,
        22,
        2022,
        'Be the bullet hell.',
        30
    ),
    (
        '20 Minutes Till Dawn',
        16,
        0.3,
        22,
        2022,
        'Lovecraftian shooter.',
        15
    ),
    (
        'Brotato',
        16,
        0.4,
        22,
        2023,
        'Potato roguelite.',
        20
    ),
    (
        'Soul Knight',
        16,
        0.6,
        22,
        2017,
        'Pixel roguelike.',
        45
    ),
    (
        'Otherworld Legends',
        16,
        0.8,
        22,
        2020,
        'Action roguelike.',
        35
    ),
    (
        'Pascal\'s Wager',
        16,
        2.5,
        2,
        2020,
        'Souls-like on mobile.',
        25
    ),
    (
        'Grimvalor',
        16,
        0.8,
        41,
        2018,
        'Dark fantasy hack & slash.',
        12
    ),
    (
        'Oddmar',
        16,
        0.5,
        4,
        2018,
        'Viking platformer.',
        8
    ),
    (
        'Leo\'s Fortune',
        16,
        0.4,
        4,
        2014,
        'Fluff ball adventure.',
        6
    ),
    (
        'Badland',
        16,
        0.2,
        4,
        2013,
        'Atmospheric side-scroller.',
        10
    ),
    (
        'Badland 2',
        16,
        0.2,
        4,
        2015,
        'More clones.',
        12
    ),
    (
        'Vector',
        16,
        0.3,
        49,
        2012,
        'Parkour runner.',
        8
    ),
    (
        'Shadow Blade',
        16,
        0.3,
        41,
        2014,
        'Ninja action.',
        6
    ),
    (
        'Swordigo',
        16,
        0.1,
        41,
        2012,
        'Classic adventure platformer.',
        15
    ),
    (
        'Oceanhorn',
        16,
        0.6,
        1,
        2013,
        'Zelda-like adventure.',
        15
    );

-- NEW GAMES BATCH 2 --
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'Half-Life 2',
        3,
        6.5,
        5,
        2004,
        'Rise and shine, Mr. Freeman.',
        15
    ),
    (
        'Deus Ex',
        3,
        0.7,
        30,
        2000,
        'Original immersive sim masterpiece.',
        25
    ),
    (
        'System Shock 2',
        3,
        0.5,
        30,
        1999,
        'Look at you, hacker.',
        20
    ),
    (
        'Thief II: The Metal Age',
        3,
        0.8,
        29,
        2000,
        'Stealth classic.',
        25
    ),
    (
        'Baldur\'s Gate II: Shadows of Amn',
        3,
        2.5,
        20,
        2000,
        'Quintessential CRPG.',
        80
    ),
    (
        'Planescape: Torment',
        3,
        1.2,
        20,
        1999,
        'What can change the nature of a man?',
        40
    ),
    (
        'Fallout 2',
        3,
        0.6,
        20,
        1998,
        'Post-nuclear RPG.',
        50
    ),
    (
        'Fallout: New Vegas',
        9,
        10.0,
        2,
        2010,
        'The game was rigged from the start.',
        60
    ),
    (
        'Dragon Age: Origins',
        9,
        20.0,
        20,
        2009,
        'Dark fantasy RPG.',
        50
    ),
    (
        'Mass Effect 2',
        9,
        15.0,
        2,
        2010,
        'Suicide mission.',
        30
    ),
    (
        'BioShock',
        9,
        6.0,
        5,
        2007,
        'No Gods or Kings. Only Man.',
        12
    ),
    (
        'Dead Space',
        9,
        7.0,
        7,
        2008,
        'Cut off their limbs.',
        12
    ),
    (
        'XCOM: Enemy Unknown',
        9,
        12.0,
        43,
        2012,
        'Defend Earth.',
        30
    ),
    (
        'Darkest Dungeon',
        3,
        1.5,
        8,
        2016,
        'Remind yourself that overconfidence is a slow and insidious killer.',
        60
    ),
    (
        'Divinity: Original Sin 2',
        3,
        60.0,
        20,
        2017,
        'Godwoken rising.',
        100
    ),
    (
        'Disco Elysium',
        3,
        20.0,
        20,
        2019,
        'Detective role-playing game.',
        30
    ),
    (
        'Outer Wilds',
        9,
        8.0,
        1,
        2019,
        'Space exploration time loop.',
        20
    ),
    (
        'Subnautica',
        3,
        6.0,
        18,
        2018,
        'Underwater survival.',
        40
    ),
    (
        'Kerbal Space Program',
        3,
        4.0,
        9,
        2011,
        'Conquer space physics.',
        100
    ),
    (
        'FTL: Faster Than Light',
        3,
        0.2,
        8,
        2012,
        'Space ship simulation roguelike.',
        20
    ),
    (
        'Into the Breach',
        3,
        0.3,
        35,
        2018,
        'Tactical mech combat.',
        15
    ),
    (
        'Baba Is You',
        3,
        0.2,
        39,
        2019,
        'Rule-changing puzzler.',
        10
    ),
    (
        'The Witness',
        9,
        5.0,
        39,
        2016,
        'Island full of puzzles.',
        25
    ),
    (
        'Braid',
        3,
        0.2,
        17,
        2008,
        'Time manipulation platformer.',
        6
    ),
    (
        'Fez',
        3,
        0.5,
        17,
        2012,
        '2D world in 3D perspective.',
        8
    ),
    (
        'Spelunky',
        3,
        0.2,
        4,
        2008,
        'Roguelike platforming origin.',
        50
    ),
    (
        'Super Meat Boy',
        3,
        0.3,
        4,
        2010,
        'Hardcore platformer.',
        10
    ),
    (
        'Vannilla WoW',
        3,
        5.0,
        38,
        2004,
        'The beginning of an era.',
        300
    ),
    (
        'EverQuest',
        3,
        2.0,
        38,
        1999,
        'The grandfather of MMOs.',
        500
    ),
    (
        'EVE Online',
        3,
        20.0,
        38,
        2003,
        'Spreadsheets in space.',
        999
    ),
    (
        'StarCraft II',
        3,
        30.0,
        43,
        2010,
        'The RTS king.',
        50
    ),
    (
        'Warcraft III: Reign of Chaos',
        3,
        1.0,
        43,
        2002,
        'Hero RTS classic.',
        30
    ),
    (
        'Age of Empires II',
        3,
        0.5,
        43,
        1999,
        'Wololo.',
        40
    ),
    (
        'Total War: Shogun 2',
        3,
        20.0,
        43,
        2011,
        'Samurai warfare.',
        60
    ),
    (
        'Command & Conquer: Red Alert 2',
        3,
        0.8,
        43,
        2000,
        'Kirov reporting.',
        20
    ),
    (
        'Homeworld',
        3,
        1.0,
        43,
        1999,
        'Space RTS opera.',
        15
    ),
    (
        'Supreme Commander',
        3,
        5.0,
        43,
        2007,
        'Massive scale RTS.',
        25
    ),
    (
        'Counter-Strike 1.6',
        3,
        0.5,
        5,
        2000,
        'Tactical shooter roots.',
        100
    ),
    (
        'Quake III Arena',
        3,
        0.5,
        5,
        1999,
        'Arena shooter perfection.',
        50
    ),
    (
        'Unreal Tournament 2004',
        3,
        3.0,
        5,
        2004,
        'Vehicle capture the flag.',
        60
    ),
    (
        'Tribes: Ascend',
        3,
        4.0,
        5,
        2012,
        'Gotta go fast.',
        30
    ),
    (
        'Halo: Combat Evolved',
        3,
        1.0,
        5,
        2001,
        'Combat Evolved.',
        10
    ),
    (
        'GoldenEye 007',
        1,
        0.012,
        5,
        1997,
        'N64 classic.',
        20
    ),
    (
        'Perfect Dark',
        1,
        0.032,
        5,
        2000,
        'Rare shooter gem.',
        25
    ),
    (
        'Metroid Prime',
        1,
        1.0,
        1,
        2002,
        'First-person adventure.',
        15
    ),
    (
        'Resident Evil',
        1,
        0.7,
        7,
        1996,
        'Enter the survival horror.',
        10
    ),
    (
        'Resident Evil 2',
        1,
        0.8,
        7,
        1998,
        'Raccoon City outbreak.',
        8
    ),
    (
        'Silent Hill 2',
        2,
        4.0,
        7,
        2001,
        'In my restless dreams, I see that town.',
        10
    ),
    (
        'Metal Gear Solid',
        2,
        0.7,
        29,
        1998,
        'Tactical Espionage Action.',
        12
    ),
    (
        'Metal Gear Solid 2: Sons of Liberty',
        2,
        4.0,
        29,
        2001,
        'La-li-lu-le-lo.',
        15
    ),
    (
        'Metal Gear Solid 3: Snake Eater',
        2,
        4.5,
        29,
        2004,
        'Survival stealth in the jungle.',
        20
    ),
    (
        'Tom Clancy\'s Splinter Cell',
        3,
        2.0,
        29,
        2002,
        'Stealth redefined.',
        12
    ),
    (
        'Hitman: Blood Money',
        3,
        3.0,
        29,
        2006,
        'Creative assassination.',
        15
    ),
    (
        'Guitar Hero II',
        13,
        4.0,
        9,
        2006,
        'Rhythm game craze.',
        20
    ),
    (
        'Rock Band',
        13,
        5.0,
        9,
        2007,
        'Full band experience.',
        30
    ),
    (
        'Tony Hawk\'s Pro Skater 2',
        2,
        0.5,
        26,
        2000,
        'Skateboarding perfection.',
        40
    ),
    (
        'Burnout 3: Takedown',
        13,
        2.5,
        11,
        2004,
        'Arcade racing destruction.',
        15
    ),
    (
        'Need for Speed: Most Wanted',
        13,
        3.0,
        11,
        2005,
        'Open world police chases.',
        20
    ),
    (
        'Midnight Club 3: DUB Edition',
        13,
        3.5,
        11,
        2005,
        'Street racing culture.',
        25
    ),
    (
        'SSX Tricky',
        2,
        1.5,
        26,
        2001,
        'Snowboarding madness.',
        15
    ),
    (
        'Devil May Cry',
        2,
        2.0,
        27,
        2001,
        'Stylish action.',
        10
    ),
    (
        'Ninja Gaiden Black',
        14,
        4.0,
        27,
        2005,
        'Hardcore ninja action.',
        15
    ),
    (
        'God of War II',
        2,
        6.0,
        27,
        2007,
        'End of Olympus.',
        12
    ),
    (
        'Okami',
        2,
        4.0,
        1,
        2006,
        'Painting wolf adventure.',
        35
    ),
    (
        'Shadow of the Colossus',
        2,
        3.0,
        1,
        2005,
        'Giant slaying tragedy.',
        8
    ),
    ('Ico', 2, 1.5, 1, 2001, 'Boy meets girl.', 6),
    (
        'Katamari Damacy',
        2,
        3.0,
        47,
        2004,
        'Roll everything up.',
        5
    ),
    (
        'Psychonauts',
        3,
        4.0,
        4,
        2005,
        'Mental platforming.',
        12
    ),
    (
        'Beyond Good & Evil',
        3,
        2.5,
        1,
        2003,
        'Journalist saves planet.',
        12
    ),
    (
        'Prince of Persia: The Sands of Time',
        3,
        1.5,
        41,
        2003,
        'Time rewinding acrobatics.',
        10
    ),
    (
        'Star Wars: Knights of the Old Republic',
        3,
        3.5,
        20,
        2003,
        'Star Wars RPG.',
        30
    ),
    (
        'Star Wars: Battlefront II (Original)',
        3,
        4.5,
        42,
        2005,
        'Classic battles.',
        50
    ),
    (
        'Jedi Knight II: Jedi Outcast',
        3,
        1.0,
        1,
        2002,
        'Best lightsaber combat.',
        15
    ),
    (
        'Republic Commando',
        3,
        2.0,
        5,
        2005,
        'Squad tactics.',
        8
    ),
    (
        'The Simpsons Hit & Run',
        3,
        2.0,
        1,
        2003,
        'GTA Springfield.',
        15
    ),
    (
        'SpongeBob SquarePants: Battle for Bikini Bottom',
        3,
        1.5,
        4,
        2003,
        'Licensed game done right.',
        12
    ),
    (
        'Bully',
        13,
        4.0,
        1,
        2006,
        'School simulator.',
        20
    ),
    (
        'Manhunt',
        3,
        2.0,
        29,
        2003,
        'Controversial stealth.',
        10
    ),
    (
        'The Warriors',
        2,
        3.0,
        35,
        2005,
        'Gang warfare.',
        12
    ),
    (
        'Max Payne 2: The Fall of Max Payne',
        3,
        1.5,
        13,
        2003,
        'Film noir shooter.',
        8
    ),
    (
        'F.E.A.R.',
        3,
        4.0,
        5,
        2005,
        'Slow-mo horror.',
        10
    ),
    (
        'Crysis',
        3,
        6.0,
        5,
        2007,
        'Can it run Crysis?',
        10
    ),
    (
        'Far Cry 2',
        3,
        5.0,
        5,
        2008,
        'Fire physics.',
        20
    ),
    (
        'S.T.A.L.K.E.R.: Shadow of Chernobyl',
        3,
        5.0,
        18,
        2007,
        'Cheeki Breeki.',
        30
    ),
    (
        'Metro 2033',
        3,
        6.0,
        5,
        2010,
        'Moscow underground.',
        10
    ),
    (
        'Spec Ops: The Line',
        3,
        6.0,
        13,
        2012,
        'Conrad is waiting.',
        6
    ),
    ('Bastion', 3, 1.0, 2, 2011, 'Narrator voice.', 8),
    (
        'Transistor',
        3,
        2.5,
        2,
        2014,
        'Sci-fi strategic action.',
        6
    ),
    (
        'Pyre',
        3,
        4.0,
        20,
        2017,
        'Fantasy basketball.',
        10
    ),
    (
        'Papers, Please',
        3,
        0.1,
        9,
        2013,
        'Glory to Arstotzka.',
        5
    ),
    (
        'Return of the Obra Dinn',
        3,
        0.8,
        39,
        2018,
        'Insurance investigation.',
        8
    ),
    ('Her Story', 3, 2.0, 9, 2015, 'FMV mystery.', 4),
    (
        'Gone Home',
        3,
        2.0,
        32,
        2013,
        'Walking simulator.',
        2
    ),
    (
        'Dear Esther',
        3,
        1.0,
        32,
        2012,
        'Poetic exploration.',
        1
    ),
    (
        'Stanley Parable',
        3,
        1.5,
        32,
        2013,
        'Choice illusion.',
        3
    ),
    (
        'The Talos Principle',
        3,
        5.0,
        39,
        2014,
        'Philosophical puzzles.',
        20
    ),
    (
        'Antichamber',
        3,
        0.5,
        39,
        2013,
        'Mind-bending geometry.',
        6
    ),
    (
        'Portal',
        3,
        1.0,
        17,
        2007,
        'The cake is a lie.',
        3
    ),
    (
        'Superhot',
        3,
        3.0,
        5,
        2016,
        'Time moves when you move.',
        4
    );

-- NEW GAMES BATCH 3 --
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'Factorio',
        3,
        3.0,
        9,
        2020,
        'The factory must grow.',
        500
    ),
    (
        'RimWorld',
        3,
        0.5,
        9,
        2018,
        'Story generator.',
        200
    ),
    (
        'Dwarf Fortress',
        3,
        0.2,
        9,
        2006,
        'Losing is fun.',
        1000
    ),
    (
        'Prison Architect',
        9,
        0.5,
        9,
        2015,
        'Build and manage a maximum security prison.',
        40
    ),
    (
        'Cities: Skylines',
        9,
        4.0,
        34,
        2015,
        'Modern city builder.',
        60
    ),
    (
        'Frostpunk',
        9,
        5.0,
        34,
        2018,
        'The city must survive.',
        20
    ),
    (
        'Banished',
        3,
        0.3,
        34,
        2014,
        'Medieval survival builder.',
        30
    ),
    (
        'Oxygen Not Included',
        3,
        2.0,
        9,
        2019,
        'Space colony simulation.',
        80
    ),
    (
        'Don\'t Starve',
        9,
        1.0,
        18,
        2013,
        'Tim Burton style survival.',
        40
    ),
    (
        'This War of Mine',
        9,
        2.0,
        18,
        2014,
        'In war, not everyone is a soldier.',
        15
    ),
    (
        'Project Zomboid',
        3,
        3.0,
        18,
        2013,
        'This is how you died.',
        100
    ),
    (
        'The Long Dark',
        9,
        7.0,
        18,
        2014,
        'Quiet apocalypse.',
        50
    ),
    (
        'Firewatch',
        9,
        4.0,
        32,
        2016,
        'Wyoming wilderness mystery.',
        5
    ),
    (
        'What Remains of Edith Finch',
        9,
        5.0,
        32,
        2017,
        'Collection of short stories.',
        3
    ),
    (
        'Oxenfree',
        9,
        3.0,
        32,
        2016,
        'Supernatural teen thriller.',
        5
    ),
    (
        'Night in the Woods',
        9,
        6.0,
        32,
        2017,
        'College dropout cat.',
        8
    ),
    (
        'Undertale',
        3,
        0.2,
        20,
        2015,
        'RPG where you don\'t have to kill.',
        6
    ),
    (
        'Deltarune',
        3,
        0.3,
        20,
        2018,
        'Don\'t forget.',
        4
    ),
    (
        'Celeste',
        9,
        1.2,
        4,
        2018,
        'Climb the mountain.',
        10
    ),
    (
        'Hollow Knight',
        9,
        9.0,
        19,
        2017,
        'Bug metroidvania.',
        40
    ),
    (
        'Ori and the Blind Forest',
        9,
        8.0,
        19,
        2015,
        'Beautiful platformer.',
        10
    ),
    (
        'Ori and the Will of the Wisps',
        9,
        10.0,
        19,
        2020,
        'Even more beautiful.',
        15
    ),
    (
        'Cuphead',
        9,
        4.0,
        21,
        2017,
        '1930s cartoon difficulty.',
        12
    ),
    (
        'Shovel Knight',
        9,
        0.3,
        4,
        2014,
        '8-bit love letter.',
        8
    ),
    (
        'The Messenger',
        9,
        1.0,
        4,
        2018,
        'Ninja gaiden tribute.',
        12
    ),
    (
        'Katana ZERO',
        9,
        0.2,
        27,
        2019,
        'Neo-noir samurai.',
        5
    ),
    (
        'Hotline Miami',
        3,
        0.5,
        40,
        2012,
        'Do you like hurting other people?',
        5
    ),
    (
        'Hotline Miami 2: Wrong Number',
        3,
        0.7,
        40,
        2015,
        'More violence.',
        8
    ),
    (
        'Enter the Gungeon',
        9,
        1.0,
        22,
        2016,
        'Gunfight dungeon crawler.',
        50
    ),
    (
        'The Binding of Isaac: Rebirth',
        9,
        0.5,
        22,
        2014,
        'Crying baby roguelike.',
        100
    ),
    (
        'Risk of Rain 2',
        9,
        2.0,
        22,
        2019,
        '3D roguelike chaos.',
        60
    ),
    (
        'Gunfire Reborn',
        3,
        3.0,
        22,
        2020,
        'FPS roguelite with cats.',
        40
    ),
    (
        'Deep Rock Galactic',
        9,
        3.0,
        5,
        2020,
        'Rock and Stone!',
        100
    ),
    (
        'Valheim',
        3,
        1.0,
        18,
        2021,
        'Viking purgatory.',
        80
    ),
    (
        'Satisfactory',
        3,
        15.0,
        9,
        2019,
        '3D Factorio.',
        150
    ),
    (
        'Dyson Sphere Program',
        3,
        5.0,
        9,
        2021,
        'Build a Dyson sphere.',
        100
    ),
    (
        'No Man\'s Sky',
        9,
        12.0,
        18,
        2016,
        'Infinite universe.',
        60
    ),
    (
        'Elite Dangerous',
        3,
        20.0,
        9,
        2014,
        '1:1 Milky Way galaxy.',
        100
    ),
    (
        'Star Citizen',
        3,
        80.0,
        9,
        2013,
        'The forever alpha.',
        200
    ),
    (
        'Mount & Blade II: Bannerlord',
        3,
        60.0,
        2,
        2020,
        'Medieval warfare sim.',
        80
    ),
    (
        'Chivalry 2',
        9,
        20.0,
        27,
        2021,
        'Medieval slasher.',
        40
    ),
    (
        'Mordhau',
        3,
        12.0,
        27,
        2019,
        'Complex melee combat.',
        50
    ),
    (
        'For Honor',
        9,
        40.0,
        12,
        2017,
        'Knights vs Vikings vs Samurai.',
        60
    ),
    (
        'Kingdom Come: Deliverance',
        3,
        50.0,
        20,
        2018,
        'Realistic medieval RPG.',
        70
    ),
    (
        'The Witcher 2: Assassins of Kings',
        3,
        18.0,
        20,
        2011,
        'Geralt\'s memory returns.',
        30
    ),
    (
        'The Witcher',
        3,
        10.0,
        20,
        2007,
        'Where it all began.',
        40
    ),
    (
        'Cyberpunk 2077: Phantom Liberty',
        9,
        30.0,
        2,
        2023,
        'Spy thriller expansion.',
        20
    ),
    (
        'Baldur\'s Gate 3',
        3,
        150.0,
        20,
        2023,
        'D&D 5e perfection.',
        100
    ),
    (
        'Divinity: Original Sin',
        3,
        10.0,
        20,
        2014,
        'Elemental combat.',
        60
    ),
    (
        'Pillars of Eternity',
        3,
        14.0,
        20,
        2015,
        'Obsidian\'s classic RPG.',
        50
    ),
    (
        'Pillars of Eternity II: Deadfire',
        3,
        18.0,
        20,
        2018,
        'Pirate RPG.',
        60
    ),
    ('Tyranny', 3, 10.0, 20, 2016, 'Evil wins.', 25),
    (
        'Pathfinder: Kingmaker',
        3,
        30.0,
        20,
        2018,
        'Complex pathfinder rules.',
        80
    ),
    (
        'Pathfinder: Wrath of the Righteous',
        3,
        35.0,
        20,
        2021,
        'Crusade against demons.',
        100
    ),
    (
        'Wasteland 3',
        9,
        25.0,
        20,
        2020,
        'Post-apocalyptic squad RPG.',
        50
    ),
    (
        'Shadowrun Returns',
        3,
        2.0,
        20,
        2013,
        'Cyberpunk fantasy.',
        15
    ),
    (
        'Shadowrun: Dragonfall',
        3,
        2.5,
        20,
        2014,
        'Best Shadowrun story.',
        20
    ),
    (
        'Shadowrun: Hong Kong',
        3,
        3.0,
        20,
        2015,
        'Cyberpunk in Asia.',
        20
    ),
    (
        'XCOM 2',
        9,
        45.0,
        43,
        2016,
        'Resistance is futile.',
        40
    ),
    (
        'Phoenix Point',
        3,
        20.0,
        43,
        2019,
        'Spiritual successor to XCOM.',
        30
    ),
    (
        'Gears Tactics',
        3,
        30.0,
        43,
        2020,
        'Gears of War RTS.',
        25
    ),
    (
        'Desperados III',
        9,
        15.0,
        43,
        2020,
        'Wild West tactics.',
        30
    ),
    (
        'Shadow Tactics: Blades of the Shogun',
        9,
        10.0,
        43,
        2016,
        'Ninja tactics.',
        25
    ),
    (
        'Invisible, Inc.',
        3,
        2.0,
        43,
        2015,
        'Spy tactics.',
        15
    ),
    (
        'Mark of the Ninja',
        3,
        3.0,
        29,
        2012,
        '2D stealth perfection.',
        10
    ),
    ('Shank', 3, 2.0, 35, 2010, 'Action brawler.', 5),
    (
        'Broforce',
        3,
        1.0,
        21,
        2015,
        'Action movie parody.',
        8
    ),
    (
        'Genital Jousting',
        3,
        0.5,
        24,
        2018,
        'Don\'t ask.',
        2
    ),
    (
        'Mount Your Friends',
        3,
        0.2,
        24,
        2014,
        'Climbing simulator.',
        3
    ),
    (
        'Gang Beasts',
        9,
        2.0,
        12,
        2014,
        'Jelly physics fighting.',
        10
    ),
    (
        'Human: Fall Flat',
        9,
        1.5,
        47,
        2016,
        'Physics puzzler.',
        10
    ),
    (
        'Totally Accurate Battle Simulator',
        3,
        3.0,
        9,
        2019,
        'Wobbly warfare.',
        15
    ),
    (
        'Goat Simulator',
        9,
        2.0,
        9,
        2014,
        'Goat chaos.',
        5
    ),
    (
        'Surgeon Simulator',
        3,
        1.0,
        9,
        2013,
        'Malpractice simulator.',
        4
    ),
    (
        'I Am Bread',
        3,
        1.5,
        9,
        2015,
        'Bread simulator.',
        5
    ),
    (
        'Octodad: Dadliest Catch',
        9,
        3.0,
        32,
        2014,
        'Nobody suspects a thing.',
        4
    ),
    (
        'Viscera Cleanup Detail',
        3,
        3.0,
        9,
        2015,
        'Space janitor.',
        10
    ),
    (
        'House Flipper',
        9,
        5.0,
        9,
        2018,
        'Renovation simulator.',
        20
    ),
    (
        'PowerWash Simulator',
        9,
        6.0,
        9,
        2021,
        'Soothing cleaning.',
        30
    ),
    (
        'PC Building Simulator',
        3,
        4.0,
        9,
        2018,
        'Meta gaming.',
        20
    ),
    (
        'Farming Simulator 22',
        9,
        15.0,
        9,
        2021,
        'Farm life.',
        100
    ),
    (
        'Euro Truck Simulator 2',
        3,
        10.0,
        9,
        2012,
        'Trucking across Europe.',
        200
    ),
    (
        'American Truck Simulator',
        3,
        8.0,
        9,
        2016,
        'Trucking across USA.',
        150
    ),
    (
        'SnowRunner',
        9,
        20.0,
        9,
        2020,
        'Off-road physics.',
        80
    ),
    (
        'MudRunner',
        9,
        1.5,
        9,
        2017,
        'Physics engine demo.',
        40
    ),
    (
        'BeamNG.drive',
        3,
        15.0,
        11,
        2015,
        'Soft-body physics.',
        100
    ),
    (
        'Wreckfest',
        9,
        20.0,
        11,
        2018,
        'Demolition derby.',
        30
    ),
    (
        'FlatOut 2',
        3,
        3.0,
        11,
        2006,
        'Driver ejection.',
        15
    ),
    (
        'Burnout Paradise',
        9,
        4.0,
        11,
        2008,
        'Take me down to the paradise city.',
        20
    ),
    (
        'Split/Second',
        3,
        6.0,
        11,
        2010,
        'Explosive racing.',
        10
    ),
    (
        'Blur',
        3,
        7.0,
        11,
        2010,
        'Mario Kart with real cars.',
        12
    ),
    (
        'Driver: San Francisco',
        3,
        8.0,
        11,
        2011,
        'Shift cars instantly.',
        15
    ),
    (
        'L.A. Noire',
        9,
        25.0,
        1,
        2011,
        'Facial animation tech.',
        20
    ),
    (
        'Mafia II',
        3,
        8.0,
        1,
        2010,
        'Empire Bay gangster.',
        15
    ),
    (
        'Mafia III',
        9,
        40.0,
        1,
        2016,
        'New Bordeaux revenge.',
        25
    ),
    (
        'Sleeping Dogs',
        9,
        15.0,
        1,
        2012,
        'Undercover in Hong Kong.',
        20
    ),
    (
        'Watch Dogs 2',
        9,
        30.0,
        1,
        2016,
        'Hacking San Francisco.',
        30
    ),
    (
        'Saints Row: The Third',
        9,
        10.0,
        1,
        2011,
        'Purple chaos.',
        20
    ),
    (
        'Saints Row IV',
        9,
        12.0,
        1,
        2013,
        'President with superpowers.',
        25
    ),
    (
        'Agents of Mayhem',
        9,
        20.0,
        1,
        2017,
        'Saints Row spin-off.',
        15
    );

-- NEW GAMES TOP 100 & 2025/2026 --
INSERT INTO videoGames (
        name,
        platform_id,
        size_gb,
        genre_id,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'Grand Theft Auto VI',
        9,
        150.0,
        1,
        2025,
        'The most anticipated game of the decade.',
        100
    ),
    (
        'Monster Hunter Wilds',
        9,
        90.0,
        2,
        2025,
        'Next generation hunting experience.',
        200
    ),
    (
        'Borderlands 4',
        9,
        80.0,
        5,
        2025,
        'Looter shooter returns.',
        50
    ),
    (
        'DOOM: The Dark Ages',
        9,
        60.0,
        5,
        2025,
        'Medieval rip and tear.',
        15
    ),
    (
        'Fable',
        5,
        100.0,
        2,
        2025,
        'New beginning for Albion.',
        40
    ),
    (
        'Metroid Prime 4: Beyond',
        1,
        15.0,
        1,
        2025,
        'Samus Aran returns.',
        20
    ),
    (
        'Death Stranding 2: On The Beach',
        2,
        120.0,
        1,
        2025,
        'Should we have connected?',
        50
    ),
    (
        'Civilization VII',
        3,
        25.0,
        43,
        2025,
        'One more turn forever.',
        200
    ),
    (
        'Mafia: The Old Country',
        9,
        70.0,
        1,
        2025,
        'Origins of the mob.',
        20
    ),
    ('Hades II', 3, 5.0, 8, 2025, 'Kill time.', 60),
    (
        'Judas',
        9,
        50.0,
        5,
        2025,
        'From the creator of BioShock.',
        20
    ),
    (
        'Marvel 1943: Rise of Hydra',
        9,
        80.0,
        1,
        2025,
        'Cap and Panther.',
        15
    ),
    (
        'South of Midnight',
        5,
        40.0,
        1,
        2025,
        'Southern gothic magic.',
        12
    ),
    (
        'Clair Obscur: Expedition 33',
        9,
        60.0,
        20,
        2025,
        'Turn-based RPG revolution.',
        40
    ),
    (
        'Atomfall',
        9,
        40.0,
        18,
        2025,
        'British fallout.',
        30
    ),
    (
        'Avowed',
        5,
        80.0,
        20,
        2025,
        'Skyrim competition from Obsidian.',
        60
    ),
    (
        'Kingdom Come: Deliverance II',
        9,
        100.0,
        20,
        2025,
        'Henry has come to see us.',
        80
    ),
    (
        'Little Nightmares III',
        9,
        10.0,
        17,
        2025,
        'Co-op nightmares.',
        8
    ),
    (
        'Professor Layton and the New World of Steam',
        1,
        5.0,
        47,
        2025,
        'Puzzle solving gentleman.',
        20
    ),
    (
        'Pokémon Legends: Z-A',
        1,
        10.0,
        2,
        2025,
        'Return to Kalos.',
        30
    ),
    (
        'Persona 6',
        9,
        50.0,
        14,
        2026,
        'The next high school journey.',
        100
    ),
    (
        'Mass Effect 5',
        9,
        100.0,
        2,
        2026,
        'N7 returns.',
        60
    ),
    (
        'The Witcher 4: Polaris',
        9,
        120.0,
        20,
        2026,
        'New saga begins.',
        100
    ),
    (
        'The Elder Scrolls VI',
        9,
        150.0,
        20,
        2026,
        'We have waited too long.',
        200
    ),
    (
        'Physint',
        2,
        80.0,
        29,
        2026,
        'Espionage action from Kojima.',
        20
    ),
    ('OD', 5, 50.0, 7, 2026, 'Horror experiment.', 10),
    (
        'Star Wars: Eclipse',
        9,
        100.0,
        1,
        2026,
        'High Republic era.',
        40
    ),
    (
        'Marvel\'s Wolverine',
        2,
        60.0,
        1,
        2026,
        'Snikt.',
        25
    ),
    (
        'Wonder Woman',
        9,
        60.0,
        1,
        2026,
        'Nemesis system returns.',
        25
    ),
    (
        'Control 2',
        9,
        70.0,
        1,
        2026,
        'Remedy connective universe.',
        20
    ),
    (
        'Max Payne 1&2 Remake',
        9,
        50.0,
        13,
        2026,
        'Bullet time definition.',
        15
    ),
    (
        'Splinter Cell Remake',
        9,
        40.0,
        29,
        2026,
        'Sam Fisher is back.',
        15
    ),
    (
        'Silent Hill f',
        9,
        40.0,
        7,
        2026,
        'Floral horror.',
        12
    ),
    (
        'Pragmata',
        9,
        50.0,
        1,
        2026,
        'Capcom space mystery.',
        15
    ),
    (
        'Dune: Awakening',
        9,
        80.0,
        18,
        2025,
        'Survival on Arrakis.',
        100
    ),
    (
        'Light No Fire',
        9,
        30.0,
        18,
        2025,
        'Fantasy earth from Hello Games.',
        100
    ),
    (
        'Honor of Kings',
        16,
        5.0,
        15,
        2015,
        'Most played MOBA globally.',
        50
    ),
    (
        'Crossfire',
        3,
        10.0,
        5,
        2007,
        'Most played FPS globally.',
        60
    ),
    (
        'Dungeon Fighter Online',
        3,
        15.0,
        35,
        2005,
        'Massive beat em up revenue.',
        80
    ),
    (
        'QQ Speed',
        16,
        2.0,
        11,
        2017,
        'Huge racing game in Asia.',
        30
    ),
    (
        'Game for Peace',
        16,
        3.0,
        6,
        2019,
        'Chinese PUBG Mobile.',
        40
    ),
    (
        'Fantasy Westward Journey',
        3,
        5.0,
        46,
        2001,
        'Legendary Chinese MMORPG.',
        200
    ),
    (
        'Westward Journey Online II',
        3,
        5.0,
        46,
        2004,
        'Classic MMORPG.',
        150
    ),
    (
        'Free Fire',
        16,
        1.0,
        6,
        2017,
        'Massive in Latin America/SEA.',
        35
    ),
    (
        'Knives Out',
        16,
        2.0,
        6,
        2017,
        'Popular Battle Royale.',
        30
    ),
    (
        'Naraka: Bladepoint',
        9,
        20.0,
        6,
        2021,
        'Melee battle royale.',
        40
    ),
    (
        'Eggy Party',
        16,
        1.0,
        4,
        2022,
        'Fall Guys mobile competitor.',
        20
    ),
    (
        'Honkai: Star Rail',
        16,
        15.0,
        14,
        2023,
        'Space fantasy RPG.',
        100
    ),
    (
        'Zenless Zone Zero',
        16,
        12.0,
        35,
        2024,
        'Urban fantasy action.',
        60
    ),
    (
        'Wuthering Waves',
        16,
        10.0,
        2,
        2024,
        'Open world action RPG.',
        50
    ),
    (
        'Solo Leveling: Arise',
        16,
        5.0,
        2,
        2024,
        'Webtoon adaptation.',
        40
    ),
    (
        'Squad Busters',
        16,
        0.5,
        43,
        2024,
        'Supercell crossover.',
        15
    ),
    (
        'Brawlhalla',
        9,
        1.0,
        12,
        2017,
        'Platform fighting.',
        30
    ),
    (
        'Warframe Mobile',
        16,
        10.0,
        2,
        2024,
        'Ninjas play free on phone.',
        100
    ),
    (
        'Rainbow Six Mobile',
        16,
        3.0,
        5,
        2024,
        'Tactical shooter portable.',
        20
    ),
    (
        'The Division Resurgence',
        16,
        5.0,
        13,
        2024,
        'Open world shooter mobile.',
        40
    ),
    (
        'Assassin\'s Creed Jade',
        16,
        8.0,
        2,
        2025,
        'AC in China on mobile.',
        50
    ),
    (
        'Valorant Mobile',
        16,
        4.0,
        5,
        2025,
        'Tactical shooter touch.',
        30
    ),
    (
        'Destiny: Rising',
        16,
        6.0,
        5,
        2025,
        'NetEase Destiny game.',
        40
    ),
    (
        'Need for Speed Mobile',
        16,
        5.0,
        11,
        2024,
        'Open world racing.',
        20
    ),
    (
        'NBA Infinite',
        16,
        3.0,
        34,
        2024,
        'Real-time basketball.',
        15
    ),
    (
        'EA Sports FC Mobile',
        16,
        2.0,
        34,
        2023,
        'Football in your pocket.',
        30
    ),
    (
        'eFootball 2025',
        16,
        3.0,
        34,
        2024,
        'Konami football.',
        30
    ),
    (
        'Dream League Soccer 2025',
        16,
        1.0,
        34,
        2025,
        'Classic mobile soccer.',
        20
    ),
    (
        '8 Ball Pool',
        16,
        0.1,
        34,
        2010,
        'Worlds biggest pool game.',
        10
    ),
    (
        'Ludo King',
        16,
        0.1,
        47,
        2016,
        'Massive board game app.',
        15
    ),
    (
        'Garena Undawn',
        16,
        4.0,
        18,
        2023,
        'Zombie survival.',
        40
    ),
    (
        'Whiteout Survival',
        16,
        1.0,
        43,
        2023,
        'Strategy survival.',
        30
    ),
    (
        'Royal Match',
        16,
        0.5,
        47,
        2021,
        'King of match-3.',
        20
    ),
    (
        'Monopoly GO!',
        16,
        0.5,
        47,
        2023,
        'Social board game.',
        15
    ),
    (
        'Coin Master',
        16,
        0.2,
        47,
        2015,
        'Attack your friends villages.',
        10
    ),
    (
        'Gardenscapes',
        16,
        0.5,
        47,
        2016,
        'Match-3 renovation.',
        30
    ),
    (
        'Homescapes',
        16,
        0.5,
        47,
        2017,
        'More renovation.',
        30
    ),
    (
        'Fishdom',
        16,
        0.4,
        47,
        2008,
        'Aquarium puzzles.',
        20
    ),
    (
        'Township',
        16,
        0.6,
        9,
        2012,
        'Farming and city building.',
        50
    ),
    ('Hay Day', 16, 0.4, 9, 2012, 'The farmgame.', 40),
    (
        'Boom Beach',
        16,
        0.3,
        43,
        2014,
        'Strategy combat.',
        30
    ),
    (
        'Brave Frontier',
        16,
        1.0,
        20,
        2013,
        'Classic gacha RPG.',
        60
    ),
    (
        'Puzzle & Dragons',
        16,
        0.5,
        17,
        2012,
        'Match-3 RPG giant.',
        50
    ),
    (
        'Monster Strike',
        16,
        0.5,
        2,
        2013,
        'Physics RPG giant.',
        50
    ),
    (
        'Granblue Fantasy',
        16,
        2.0,
        20,
        2014,
        'Browser/Mobile RPG.',
        100
    ),
    (
        'Princess Connect! Re: Dive',
        16,
        4.0,
        20,
        2018,
        'Anime RPG.',
        40
    ),
    (
        'Uma Musume Pretty Derby',
        16,
        5.0,
        9,
        2021,
        'Horse girl racing.',
        50
    ),
    (
        'Dragon Ball Z Dokkan Battle',
        16,
        1.0,
        47,
        2015,
        'Bubble popping battles.',
        60
    ),
    (
        'Dragon Ball Legends',
        16,
        20.0,
        12,
        2018,
        'Card action battles.',
        40
    ),
    (
        'One Piece Treasure Cruise',
        16,
        1.5,
        20,
        2014,
        'Pirate RPG.',
        50
    ),
    (
        'One Piece Bounty Rush',
        16,
        1.5,
        1,
        2018,
        '4v4 looting.',
        30
    ),
    (
        'Bleach: Brave Souls',
        16,
        2.0,
        35,
        2015,
        'Hack and slash anime.',
        40
    ),
    (
        'Naruto x Boruto Ninja Voltage',
        16,
        1.0,
        43,
        2017,
        'Fortress strategy.',
        20
    ),
    (
        'Yu-Gi-Oh! Duel Links',
        16,
        3.0,
        23,
        2016,
        'Speed duels.',
        50
    ),
    (
        'Yu-Gi-Oh! Master Duel',
        9,
        5.0,
        23,
        2022,
        'Definitive card game.',
        60
    ),
    (
        'Magic: The Gathering Arena',
        3,
        4.0,
        23,
        2018,
        'Digital MTG.',
        50
    ),
    (
        'Shadowverse',
        16,
        2.0,
        23,
        2016,
        'Anime card battles.',
        40
    ),
    (
        'Teppen',
        16,
        2.0,
        23,
        2019,
        'Capcom card battler.',
        20
    ),
    (
        'Gwent: The Witcher Card Game',
        9,
        3.0,
        23,
        2018,
        'Round of Gwent?',
        30
    ),
    (
        'Eternal Card Game',
        9,
        2.0,
        23,
        2016,
        'Fair F2P card game.',
        30
    ),
    (
        'Minion Masters',
        3,
        2.0,
        43,
        2016,
        'Fast paced minion battles.',
        20
    ),
    (
        'Clash Mini',
        16,
        0.5,
        43,
        2021,
        'Board game strategy.',
        15
    ),
    (
        'Warcraft Rumble',
        16,
        1.0,
        43,
        2023,
        'Tower offense.',
        20
    );
