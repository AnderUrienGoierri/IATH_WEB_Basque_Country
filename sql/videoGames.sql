CREATE DATABASE IF NOT EXISTS video_games_quiz_db;
USE video_games_quiz_db;

CREATE TABLE videoGames (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    platform VARCHAR(100),
    size_gb DECIMAL(10, 2),
    genre VARCHAR(100),
    release_year INT,
    more_data TEXT,
    average_playgame_duration INT
);
INSERT INTO videoGames (
        name,
        platform,
        size_gb,
        genre,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'The Legend of Zelda: Breath of the Wild',
        'Nintendo Switch',
        14.4,
        'Action-Adventure',
        2017,
        'An open-world action-adventure game developed and published by Nintendo.',
        129
    ),
    (
        'God of War Ragnarök',
        'PlayStation 5',
        84.0,
        'Action-Adventure',
        2022,
        'Action-adventure game developed by Santa Monica Studio and published by Sony Interactive Entertainment.',
        60
    ),
    (
        'Elden Ring',
        'PC, PS5, Xbox Series X/S',
        60.0,
        'Action RPG',
        2022,
        'A fantasy action-RPG adventure set within the world created by Hidetaka Miyazaki and George R.R. Martin.',
        123
    ),
    (
        'Red Dead Redemption 2',
        'PC, PS4, Xbox One',
        150.0,
        'Action-Adventure',
        2018,
        'Epic tale of life in America’s unforgiving heartland.',
        77
    ),
    (
        'The Witcher 3: Wild Hunt',
        'PC, PS4, Xbox One, Switch',
        35.0,
        'Action RPG',
        2015,
        'Story-driven open world RPG set in a visually stunning fantasy universe.',
        65
    ),
    (
        'Cyberpunk 2077',
        'PC, PS5, Xbox Series X/S',
        70.0,
        'Action RPG',
        2020,
        'Open-world, action-adventure story set in Night City.',
        137
    ),
    (
        'Grand Theft Auto V',
        'PC, PS5, Xbox Series X/S',
        72.0,
        'Action-Adventure',
        2013,
        'Open world game set in the fictional state of San Andreas.',
        53
    ),
    (
        'Minecraft',
        'Multi-platform',
        1.0,
        'Sandbox',
        2011,
        'Sandbox game developed by Mojang Studios.',
        128
    ),
    (
        'Super Mario Odyssey',
        'Nintendo Switch',
        5.7,
        'Platformer',
        2017,
        '3D platform game developed and published by Nintendo.',
        85
    ),
    (
        'Horizon Forbidden West',
        'PlayStation 5',
        98.0,
        'Action RPG',
        2022,
        'Sequel to Horizon Zero Dawn, following Aloy in a post-apocalyptic western United States.',
        29
    ),
    (
        'Call of Duty: Modern Warfare II',
        'PC, PS5, Xbox Series X/S',
        125.0,
        'FPS',
        2022,
        'First-person shooter game developed by Infinity Ward.',
        113
    ),
    (
        'Overwatch 2',
        'PC, PS5, Xbox Series X/S, Switch',
        30.0,
        'FPS',
        2022,
        'Team-based multiplayer first-person shooter.',
        110
    ),
    (
        'Fortnite',
        'Multi-platform',
        26.0,
        'Battle Royale',
        2017,
        'Free-to-play battle royale game developed by Epic Games.',
        44
    ),
    (
        'Apex Legends',
        'Multi-platform',
        80.0,
        'Battle Royale',
        2019,
        'Free-to-play battle royale-hero shooter game developed by Respawn Entertainment.',
        132
    ),
    (
        'Final Fantasy VII Remake',
        'PC, PS5, PS4',
        100.0,
        'Action RPG',
        2020,
        'Action role-playing game developed and published by Square Enix.',
        61
    ),
    (
        'Resident Evil 4 Remake',
        'PC, PS5, Xbox Series X/S',
        67.0,
        'Survival Horror',
        2023,
        'Survival horror game developed and published by Capcom.',
        47
    ),
    (
        'Hogwarts Legacy',
        'PC, PS5, Xbox Series X/S',
        85.0,
        'Action RPG',
        2023,
        'Immersive, open-world action RPG set in the world first introduced in the Harry Potter books.',
        124
    ),
    (
        'Spider-Man: Miles Morales',
        'PlayStation 5, PC',
        50.0,
        'Action-Adventure',
        2020,
        'Action-adventure game developed by Insomniac Games.',
        134
    ),
    (
        'Ghost of Tsushima',
        'PlayStation 4, PS5',
        60.0,
        'Action-Adventure',
        2020,
        'Action-adventure game developed by Sucker Punch Productions.',
        4
    ),
    (
        'Demon\'s Souls',
        'PlayStation 5',
        66.0,
        'Action RPG',
        2020,
        'Remake of the classic action RPG developed by Bluepoint Games.',
        90
    ),
    (
        'Ratchet & Clank: Rift Apart',
        'PlayStation 5, PC',
        33.0,
        'Platformer',
        2021,
        'Third-person shooter platform game developed by Insomniac Games.',
        45
    ),
    (
        'Returnal',
        'PlayStation 5, PC',
        56.0,
        'Roguelike',
        2021,
        'Third-person shooter roguelike video game developed by Housemarque.',
        143
    ),
    (
        'It Takes Two',
        'PC, PS5, Xbox Series X/S',
        43.0,
        'Action-Adventure',
        2021,
        'Co-op action-adventure platformer developed by Hazelight Studios.',
        133
    ),
    (
        'Hades',
        'Multi-platform',
        15.0,
        'Roguelike',
        2020,
        'Roguelike action dungeon crawler developed by Supergiant Games.',
        39
    ),
    (
        'Stardew Valley',
        'Multi-platform',
        0.5,
        'Simulation',
        2016,
        'Simulation role-playing video game developed by Eric "ConcernedApe" Barone.',
        10
    ),
    (
        'Animal Crossing: New Horizons',
        'Nintendo Switch',
        10.0,
        'Social Simulation',
        2020,
        'Life simulation game developed and published by Nintendo.',
        131
    ),
    (
        'Mario Kart 8 Deluxe',
        'Nintendo Switch',
        8.0,
        'Racing',
        2017,
        'Kart racing game developed and published by Nintendo.',
        116
    ),
    (
        'Super Smash Bros. Ultimate',
        'Nintendo Switch',
        17.0,
        'Fighting',
        2018,
        'Crossover fighting game developed by Bandai Namco Studios and Sora Ltd.',
        73
    ),
    (
        'Splatoon 3',
        'Nintendo Switch',
        6.0,
        'TPS',
        2022,
        'Third-person shooter game developed and published by Nintendo.',
        52
    ),
    (
        'Xenoblade Chronicles 3',
        'Nintendo Switch',
        14.0,
        'JRPG',
        2022,
        'Action role-playing game developed by Monolith Soft.',
        60
    ),
    (
        'Persona 5 Royal',
        'Multi-platform',
        41.0,
        'JRPG',
        2019,
        'Role-playing video game developed by Atlus.',
        115
    ),
    (
        'Dragon Quest XI S: Echoes of an Elusive Age',
        'Multi-platform',
        40.0,
        'JRPG',
        2019,
        'Role-playing video game developed by Square Enix.',
        2
    ),
    (
        'Baldur\'s Gate 3',
        'PC, PS5, Xbox Series X/S',
        150.0,
        'CRPG',
        2023,
        'Role-playing video game developed and published by Larian Studios.',
        68
    ),
    (
        'Diablo IV',
        'PC, PS5, Xbox Series X/S',
        90.0,
        'Action RPG',
        2023,
        'Action role-playing game developed and published by Blizzard Entertainment.',
        135
    ),
    (
        'Starfield',
        'PC, Xbox Series X/S',
        125.0,
        'Action RPG',
        2023,
        'Action role-playing game developed by Bethesda Game Studios.',
        64
    ),
    (
        'Forza Horizon 5',
        'PC, Xbox Series X/S',
        110.0,
        'Racing',
        2021,
        'Racing game set in an open world environment based in Mexico.',
        61
    ),
    (
        'Halo Infinite',
        'PC, Xbox Series X/S',
        50.0,
        'FPS',
        2021,
        'First-person shooter game developed by 343 Industries.',
        71
    ),
    (
        'Gears 5',
        'PC, Xbox One',
        80.0,
        'TPS',
        2019,
        'Third-person shooter developed by The Coalition.',
        128
    ),
    (
        'Sea of Thieves',
        'PC, Xbox Series X/S',
        50.0,
        'Action-Adventure',
        2018,
        'Action-adventure game developed by Rare.',
        69
    ),
    (
        'Microsoft Flight Simulator',
        'PC, Xbox Series X/S',
        150.0,
        'Simulation',
        2020,
        'Amateur flight simulator developed by Asobo Studio.',
        120
    ),
    (
        'Valorant',
        'PC',
        20.0,
        'FPS',
        2020,
        'Free-to-play first-person tactical hero shooter developed by Riot Games.',
        106
    ),
    (
        'League of Legends',
        'PC',
        22.0,
        'MOBA',
        2009,
        'Multiplayer online battle arena video game developed by Riot Games.',
        143
    ),
    (
        'Dota 2',
        'PC',
        45.0,
        'MOBA',
        2013,
        'Multiplayer online battle arena video game developed by Valve.',
        135
    ),
    (
        'Counter-Strike 2',
        'PC',
        30.0,
        'FPS',
        2023,
        'Multiplayer tactical first-person shooter developed by Valve.',
        134
    ),
    (
        'Team Fortress 2',
        'PC',
        24.0,
        'FPS',
        2007,
        'Multiplayer first-person shooter game developed by Valve.',
        121
    ),
    (
        'Half-Life: Alyx',
        'PC (VR)',
        68.0,
        'VR FPS',
        2020,
        'Virtual reality first-person shooter developed by Valve.',
        16
    ),
    (
        'Portal 2',
        'PC, PS3, Xbox 360',
        12.0,
        'Puzzle-Platformer',
        2011,
        'Puzzle-platform game developed by Valve.',
        136
    ),
    (
        'Left 4 Dead 2',
        'PC, Xbox 360',
        14.0,
        'FPS',
        2009,
        'Cooperative first-person shooter developed by Valve.',
        67
    ),
    (
        'Rust',
        'PC, PS4, Xbox One',
        25.0,
        'Survival',
        2013,
        'Multiplayer-only survival video game developed by Facepunch Studios.',
        145
    ),
    (
        'Ark: Survival Evolved',
        'Multi-platform',
        100.0,
        'Survival',
        2017,
        'Action-adventure survival video game developed by Studio Wildcard.',
        72
    ),
    (
        'Valheim',
        'PC, Xbox Series X/S',
        2.0,
        'Survival',
        2021,
        'Survival and sandbox video game developed by Iron Gate Studio.',
        105
    ),
    (
        'Terraria',
        'Multi-platform',
        0.5,
        'Sandbox',
        2011,
        'Action-adventure sandbox game developed by Re-Logic.',
        77
    ),
    (
        'Hollow Knight',
        'Multi-platform',
        9.0,
        'Metroidvania',
        2017,
        'Metroidvania video game developed and published by Team Cherry.',
        99
    ),
    (
        'Celeste',
        'Multi-platform',
        1.2,
        'Platformer',
        2018,
        'Platforming video game developed by Maddy Makes Games.',
        51
    ),
    (
        'Undertale',
        'Multi-platform',
        0.3,
        'RPG',
        2015,
        'Role-playing video game created by indie developer Toby Fox.',
        64
    ),
    (
        'Cuphead',
        'Multi-platform',
        4.0,
        'Run and Gun',
        2017,
        'Run and gun video game developed and published by Studio MDHR.',
        127
    ),
    (
        'Dead Cells',
        'Multi-platform',
        1.5,
        'Roguelite',
        2018,
        'Roguelite-metroidvania hybrid developed by Motion Twin.',
        126
    ),
    (
        'Slay the Spire',
        'Multi-platform',
        1.0,
        'Deckbuilder',
        2019,
        'Roguelike deck-building video game developed by Mega Crit.',
        61
    ),
    (
        'Among Us',
        'Multi-platform',
        0.5,
        'Social Deduction',
        2018,
        'Online multiplayer social deduction game developed by Innersloth.',
        22
    ),
    (
        'Fall Guys',
        'Multi-platform',
        4.0,
        'Platform Battle Royale',
        2020,
        'Platform battle royale game developed by Mediatonic.',
        127
    ),
    (
        'Rocket League',
        'Multi-platform',
        20.0,
        'Sports',
        2015,
        'Vehicular soccer video game developed by Psyonix.',
        30
    ),
    (
        'FIFA 23',
        'Multi-platform',
        50.0,
        'Sports',
        2022,
        'Football simulation video game published by Electronic Arts.',
        88
    ),
    (
        'NBA 2K23',
        'Multi-platform',
        110.0,
        'Sports',
        2022,
        'Basketball simulation video game developed by Visual Concepts.',
        131
    ),
    (
        'Madden NFL 23',
        'Multi-platform',
        50.0,
        'Sports',
        2022,
        'American football video game based on the National Football League.',
        88
    ),
    (
        'Gran Turismo 7',
        'PlayStation 5, PS4',
        110.0,
        'Racing',
        2022,
        'Racing simulation video game developed by Polyphony Digital.',
        108
    ),
    (
        'F1 23',
        'Multi-platform',
        50.0,
        'Racing',
        2023,
        'Racing video game developed by Codemasters.',
        40
    ),
    (
        'Street Fighter 6',
        'PC, PS5, Xbox Series X/S',
        60.0,
        'Fighting',
        2023,
        'Fighting game developed and published by Capcom.',
        9
    ),
    (
        'Tekken 8',
        'PC, PS5, Xbox Series X/S',
        80.0,
        'Fighting',
        2024,
        'Fighting game developed by Bandai Namco Studios and Arika.',
        146
    ),
    (
        'Mortal Kombat 1',
        'PC, PS5, Xbox Series X/S',
        100.0,
        'Fighting',
        2023,
        'Fighting game developed by NetherRealm Studios.',
        17
    ),
    (
        'Guilty Gear Strive',
        'Multi-platform',
        20.0,
        'Fighting',
        2021,
        'Fighting video game developed and published by Arc System Works.',
        125
    ),
    (
        'Monster Hunter: World',
        'PC, PS4, Xbox One',
        50.0,
        'Action RPG',
        2018,
        'Action role-playing game developed and published by Capcom.',
        136
    ),
    (
        'Monster Hunter Rise',
        'PC, Switch, PS5, Xbox',
        25.0,
        'Action RPG',
        2021,
        'Action role-playing game developed and published by Capcom.',
        73
    ),
    (
        'Dark Souls III',
        'PC, PS4, Xbox One',
        25.0,
        'Action RPG',
        2016,
        'Action role-playing game developed by FromSoftware.',
        96
    ),
    (
        'Bloodborne',
        'PlayStation 4',
        36.0,
        'Action RPG',
        2015,
        'Action role-playing game developed by FromSoftware.',
        58
    ),
    (
        'Sekiro: Shadows Die Twice',
        'PC, PS4, Xbox One',
        25.0,
        'Action-Adventure',
        2019,
        'Action-adventure game developed by FromSoftware.',
        50
    ),
    (
        'Nier: Automata',
        'Multi-platform',
        50.0,
        'Action RPG',
        2017,
        'Action role-playing game developed by PlatinumGames.',
        22
    ),
    (
        'Bayonetta 3',
        'Nintendo Switch',
        15.0,
        'Hack and Slash',
        2022,
        'Action-adventure game developed by PlatinumGames.',
        36
    ),
    (
        'Devil May Cry 5',
        'PC, PS5, Xbox Series X/S',
        35.0,
        'Hack and Slash',
        2019,
        'Action-adventure game developed and published by Capcom.',
        75
    ),
    (
        'Resident Evil Village',
        'PC, PS5, Xbox Series X/S',
        28.0,
        'Survival Horror',
        2021,
        'Survival horror game developed and published by Capcom.',
        76
    ),
    (
        'Silent Hill 2 Remake',
        'PC, PS5',
        50.0,
        'Survival Horror',
        2024,
        'Survival horror game developed by Bloober Team.',
        83
    ),
    (
        'Alan Wake 2',
        'PC, PS5, Xbox Series X/S',
        90.0,
        'Survival Horror',
        2023,
        'Survival horror game developed by Remedy Entertainment.',
        100
    ),
    (
        'Control',
        'Multi-platform',
        42.0,
        'Action-Adventure',
        2019,
        'Action-adventure game developed by Remedy Entertainment.',
        34
    ),
    (
        'Death Stranding',
        'PC, PS5, PS4',
        80.0,
        'Action',
        2019,
        'Action game developed by Kojima Productions.',
        12
    ),
    (
        'Metal Gear Solid V: The Phantom Pain',
        'PC, PS4, Xbox One',
        28.0,
        'Stealth',
        2015,
        'Stealth game developed by Kojima Productions.',
        78
    ),
    (
        'Hitman 3',
        'Multi-platform',
        60.0,
        'Stealth',
        2021,
        'Stealth game developed by IO Interactive.',
        111
    ),
    (
        'Dishonored 2',
        'PC, PS4, Xbox One',
        60.0,
        'Stealth',
        2016,
        'Action-adventure game developed by Arkane Studios.',
        118
    ),
    (
        'Prey',
        'PC, PS4, Xbox One',
        40.0,
        'Immersive Sim',
        2017,
        'First-person shooter developed by Arkane Austin.',
        93
    ),
    (
        'BioShock Infinite',
        'PC, PS3, Xbox 360',
        20.0,
        'FPS',
        2013,
        'First-person shooter developed by Irrational Games.',
        147
    ),
    (
        'Mass Effect Legendary Edition',
        'Multi-platform',
        120.0,
        'Action RPG',
        2021,
        'Compilation of the video games in the Mass Effect trilogy.',
        29
    ),
    (
        'Fallout 4',
        'PC, PS4, Xbox One',
        30.0,
        'Action RPG',
        2015,
        'Action role-playing game developed by Bethesda Game Studios.',
        133
    ),
    (
        'Skyrim: Special Edition',
        'Multi-platform',
        12.0,
        'Action RPG',
        2016,
        'Action role-playing game developed by Bethesda Game Studios.',
        42
    ),
    (
        'Kingdom Hearts III',
        'Multi-platform',
        40.0,
        'Action RPG',
        2019,
        'Action role-playing game developed and published by Square Enix.',
        95
    ),
    (
        'Final Fantasy XVI',
        'PlayStation 5',
        90.0,
        'Action RPG',
        2023,
        'Action role-playing game developed and published by Square Enix.',
        101
    ),
    (
        'Tales of Arise',
        'Multi-platform',
        45.0,
        'JRPG',
        2021,
        'Action role-playing game developed and published by Bandai Namco Entertainment.',
        59
    ),
    (
        'Yakuza: Like a Dragon',
        'Multi-platform',
        50.0,
        'JRPG',
        2020,
        'Role-playing video game developed by Ryu Ga Gotoku Studio.',
        139
    ),
    (
        'Judgment',
        'Multi-platform',
        40.0,
        'Action-Adventure',
        2018,
        'Action-adventure game developed by Ryu Ga Gotoku Studio.',
        38
    ),
    (
        'Lost Judgment',
        'Multi-platform',
        60.0,
        'Action-Adventure',
        2021,
        'Sequel to the 2018 game Judgment.',
        136
    ),
    (
        'Genshin Impact',
        'Multi-platform',
        70.0,
        'Action RPG',
        2020,
        'Action role-playing game developed by miHoYo.',
        102
    ),
    (
        'Honkai: Star Rail',
        'Multi-platform',
        30.0,
        'Turn-based RPG',
        2023,
        'Role-playing video game developed by miHoYo.',
        124
    ),
    (
        'Destiny 2',
        'Multi-platform',
        105.0,
        'FPS',
        2017,
        'Free-to-play online-only multiplayer first-person shooter developed by Bungie.',
        129
    );
INSERT INTO videoGames (
        name,
        platform,
        size_gb,
        genre,
        release_year,
        more_data,
        average_playgame_duration
    )
VALUES (
        'The Last of Us Part I',
        'PlayStation 5, PC',
        80.0,
        'Action-Adventure',
        2022,
        'Action-adventure game developed by Naughty Dog.',
        135
    ),
    (
        'The Last of Us Part II',
        'PlayStation 4, PS5',
        100.0,
        'Action-Adventure',
        2020,
        'Action-adventure game developed by Naughty Dog.',
        88
    ),
    (
        'Uncharted 4: A Thief''s End',
        'PlayStation 4, PS5, PC',
        50.0,
        'Action-Adventure',
        2016,
        'Action-adventure game developed by Naughty Dog.',
        122
    ),
    (
        'Detroit: Become Human',
        'PlayStation 4, PC',
        45.0,
        'Adventure',
        2018,
        'Adventure game developed by Quantic Dream.',
        117
    ),
    (
        'Heavy Rain',
        'PlayStation 3, PS4, PC',
        15.0,
        'Adventure',
        2010,
        'Interactive drama action-adventure video game developed by Quantic Dream.',
        90
    ),
    (
        'Beyond: Two Souls',
        'PlayStation 3, PS4, PC',
        25.0,
        'Adventure',
        2013,
        'Interactive drama action-adventure video game developed by Quantic Dream.',
        70
    ),
    (
        'Life is Strange',
        'Multi-platform',
        14.0,
        'Adventure',
        2015,
        'Episodic graphic adventure video game developed by Dontnod Entertainment.',
        116
    ),
    (
        'The Sims 4',
        'Multi-platform',
        20.0,
        'Life Simulation',
        2014,
        'Life simulation game developed by Maxis and published by Electronic Arts.',
        131
    ),
    (
        'Cities: Skylines',
        'Multi-platform',
        12.0,
        'City-building',
        2015,
        'City-building game developed by Colossal Order.',
        16
    ),
    (
        'Planet Zoo',
        'PC, PS5, Xbox Series X/S',
        16.0,
        'Simulation',
        2019,
        'Construction and management simulation video game developed by Frontier Developments.',
        81
    ),
    (
        'Total War: Warhammer III',
        'PC',
        120.0,
        'Strategy',
        2022,
        'Turn-based strategy and real-time tactics video game developed by Creative Assembly.',
        127
    ),
    (
        'Crusader Kings III',
        'PC, PS5, Xbox Series X/S',
        8.0,
        'Grand Strategy',
        2020,
        'Grand strategy role-playing video game developed by Paradox Development Studio.',
        35
    ),
    (
        'Europa Universalis IV',
        'PC',
        6.0,
        'Grand Strategy',
        2013,
        'Grand strategy wargame developed by Paradox Development Studio.',
        56
    ),
    (
        'Hearts of Iron IV',
        'PC',
        2.0,
        'Grand Strategy',
        2016,
        'Grand strategy computer wargame developed by Paradox Development Studio.',
        22
    ),
    (
        'Stellaris',
        'Multi-platform',
        10.0,
        'Grand Strategy',
        2016,
        '4X grand strategy video game developed by Paradox Development Studio.',
        24
    ),
    (
        'RimWorld',
        'PC, PS4, Xbox One',
        1.0,
        'Construction and Management Simulation',
        2018,
        'Construction and management simulation created by Ludeon Studios.',
        74
    ),
    (
        'Factorio',
        'PC, Switch',
        3.0,
        'Construction and Management Simulation',
        2020,
        'Construction and management simulation game developed by Wube Software.',
        69
    ),
    (
        'Satisfactory',
        'PC',
        15.0,
        'Simulation',
        2020,
        'First-person open-world factory building game developed by Coffee Stain Studios.',
        44
    ),
    (
        'Deep Rock Galactic',
        'Multi-platform',
        3.0,
        'FPS',
        2020,
        'Cooperative first-person shooter video game developed by Ghost Ship Games.',
        46
    ),
    (
        'Payday 2',
        'Multi-platform',
        83.0,
        'FPS',
        2013,
        'Cooperative first-person shooter video game developed by Overkill Software.',
        131
    ),
    (
        'Warframe',
        'Multi-platform',
        35.0,
        'TPS',
        2013,
        'Free-to-play action role-playing third-person shooter multiplayer online game developed by Digital Extremes.',
        67
    ),
    (
        'World of Warcraft',
        'PC',
        100.0,
        'MMORPG',
        2004,
        'Massively multiplayer online role-playing game released by Blizzard Entertainment.',
        14
    ),
    (
        'Final Fantasy XIV',
        'PC, PS5, Xbox Series X/S',
        80.0,
        'MMORPG',
        2013,
        'Massively multiplayer online role-playing game developed and published by Square Enix.',
        87
    ),
    (
        'The Elder Scrolls Online',
        'Multi-platform',
        95.0,
        'MMORPG',
        2014,
        'Massively multiplayer online role-playing game developed by ZeniMax Online Studios.',
        43
    ),
    (
        'Guild Wars 2',
        'PC',
        55.0,
        'MMORPG',
        2012,
        'Massively multiplayer online role-playing game developed by ArenaNet.',
        51
    ),
    (
        'Black Desert Online',
        'Multi-platform',
        50.0,
        'MMORPG',
        2015,
        'Sandbox-oriented massively multiplayer online role-playing game by Korean video game developer Pearl Abyss.',
        142
    ),
    (
        'Lost Ark',
        'PC',
        70.0,
        'MMORPG',
        2019,
        'Top-down 2.5D massive multiplayer online action role-playing game co-developed by Tripod Studio and Smilegate RPG.',
        143
    ),
    (
        'Path of Exile',
        'Multi-platform',
        40.0,
        'Action RPG',
        2013,
        'Free-to-play action role-playing video game developed and published by Grinding Gear Games.',
        137
    ),
    (
        'Smite',
        'Multi-platform',
        30.0,
        'MOBA',
        2014,
        'Free-to-play, third-person multiplayer online battle arena video game developed and published by Hi-Rez Studios.',
        71
    ),
    (
        'Paladins',
        'Multi-platform',
        30.0,
        'FPS',
        2018,
        'Free-to-play online hero shooter video game by Hi-Rez Studios.',
        52
    ),
    (
        'Realm Royale',
        'Multi-platform',
        15.0,
        'Battle Royale',
        2018,
        'Free-to-play battle royale game developed by Heroic Leap Games.',
        2
    ),
    (
        'PUBG: Battlegrounds',
        'Multi-platform',
        40.0,
        'Battle Royale',
        2017,
        'Online multiplayer battle royale game developed and published by PUBG Corporation.',
        142
    ),
    (
        'DayZ',
        'Multi-platform',
        25.0,
        'Survival',
        2018,
        'Survival video game developed and published by Bohemia Interactive.',
        26
    ),
    (
        'SCUM',
        'PC',
        70.0,
        'Survival',
        2018,
        'Multiplayer online survival game, developed by Croatian studio Gamepires.',
        46
    ),
    (
        '7 Days to Die',
        'Multi-platform',
        12.0,
        'Survival Horror',
        2013,
        'Survival horror video game set in an open world developed by The Fun Pimps.',
        133
    ),
    (
        'The Forest',
        'Multi-platform',
        5.0,
        'Survival Horror',
        2018,
        'Survival horror video game developed and published by Endnight Games.',
        8
    ),
    (
        'Sons of the Forest',
        'PC',
        20.0,
        'Survival Horror',
        2023,
        'Survival horror video game developed by Endnight Games and published by Newnight.',
        70
    ),
    (
        'Green Hell',
        'Multi-platform',
        8.0,
        'Survival',
        2019,
        'Survival simulator set in an uncharted Amazonian rainforest developed by Creepy Jar.',
        58
    ),
    (
        'Stranded Deep',
        'Multi-platform',
        4.0,
        'Survival',
        2015,
        'Survival video game developed by Australian studio Beam Team Games.',
        117
    ),
    (
        'Raft',
        'PC',
        10.0,
        'Survival',
        2018,
        'Open world survival video game developed by Redbeet Interactive.',
        98
    ),
    (
        'Tunic',
        'Multi-platform',
        3.0,
        'Action-Adventure',
        2022,
        'Action-adventure game developed by Andrew Shouldice.',
        25
    ),
    (
        'Cult of the Lamb',
        'Multi-platform',
        4.0,
        'Roguelike',
        2022,
        'Roguelike video game developed by indie developer Massive Monster.',
        73
    ),
    (
        'Inscryption',
        'Multi-platform',
        3.0,
        'Deckbuilder',
        2021,
        'Deck-building game developed by Daniel Mullins Games.',
        107
    ),
    (
        'Loop Hero',
        'Multi-platform',
        0.5,
        'Roguelike',
        2021,
        'Endless RPG developed by Russian studio Four Quarters.',
        93
    ),
    (
        'Return of the Obra Dinn',
        'Multi-platform',
        2.0,
        'Puzzle',
        2018,
        'Puzzle video game created by Lucas Pope.',
        111
    ),
    (
        'Papers, Please',
        'Multi-platform',
        0.1,
        'Puzzle',
        2013,
        'Puzzle simulation video game created by indie developer Lucas Pope.',
        140
    ),
    (
        'Hotline Miami',
        'Multi-platform',
        0.6,
        'Top-down Shooter',
        2012,
        'Top-down shooter video game by Dennaton Games.',
        13
    ),
    (
        'Katana Zero',
        'Multi-platform',
        0.4,
        'Action-Platformer',
        2019,
        '2D action platform video game developed by Askiisoft.',
        143
    ),
    (
        'Gris',
        'Multi-platform',
        4.0,
        'Platformer',
        2018,
        'Platform-adventure game by Spanish developer Nomada Studio.',
        137
    ),
    (
        'Journey',
        'Multi-platform',
        4.0,
        'Adventure',
        2012,
        'Indie adventure game developed by Thatgamecompany.',
        37
    ),
    (
        'Abzû',
        'Multi-platform',
        5.0,
        'Adventure',
        2016,
        'Adventure video game developed by Giant Squid Studios.',
        131
    ),
    (
        'Firewatch',
        'Multi-platform',
        4.0,
        'Adventure',
        2016,
        'Adventure game developed by Campo Santo.',
        53
    ),
    (
        'What Remains of Edith Finch',
        'Multi-platform',
        5.0,
        'Adventure',
        2017,
        'Adventure game developed by Giant Sparrow.',
        43
    ),
    (
        'Outer Wilds',
        'Multi-platform',
        10.0,
        'Action-Adventure',
        2019,
        'Action-adventure game developed by Mobius Digital.',
        47
    ),
    (
        'The Stanley Parable: Ultra Deluxe',
        'Multi-platform',
        5.0,
        'Adventure',
        2022,
        'Interactive drama and walking simulator designed by Davey Wreden.',
        104
    ),
    (
        'Super Meat Boy',
        'Multi-platform',
        0.4,
        'Platformer',
        2010,
        'Platform game designed by Edmund McMillen and Tommy Refenes.',
        54
    ),
    (
        'The Binding of Isaac: Rebirth',
        'Multi-platform',
        1.0,
        'Roguelike',
        2014,
        'Indie roguelike video game designed by Edmund McMillen.',
        21
    ),
    (
        'Spelunky 2',
        'Multi-platform',
        1.0,
        'Platformer',
        2020,
        'Platform game developed by Mossmouth and BlitWorks.',
        146
    ),
    (
        'Don''t Starve Together',
        'Multi-platform',
        3.0,
        'Survival',
        2016,
        'Multiplayer expansion of the uncompromising wilderness survival game Don''t Starve.',
        75
    ),
    (
        'Oxygen Not Included',
        'PC',
        3.0,
        'Simulation',
        2019,
        'Survival simulation video game developed and published by Klei Entertainment.',
        92
    ),
    (
        'Kenshi',
        'PC',
        14.0,
        'RPG',
        2018,
        'Role-playing video game developed and published by Lo-Fi Games.',
        70
    ),
    (
        'Mount & Blade II: Bannerlord',
        'Multi-platform',
        60.0,
        'Action RPG',
        2022,
        'Strategy action role-playing video game developed by TaleWorlds Entertainment.',
        95
    ),
    (
        'Chivalry 2',
        'Multi-platform',
        20.0,
        'Hack and Slash',
        2021,
        'Multiplayer hack and slash action video game developed by Torn Banner Studios.',
        20
    ),
    (
        'Mordhau',
        'PC, PS5, Xbox Series X/S',
        20.0,
        'Hack and Slash',
        2019,
        'Multiplayer medieval hack and slash video game developed by Triternion.',
        141
    ),
    (
        'For Honor',
        'Multi-platform',
        90.0,
        'Fighting',
        2017,
        'Action fighting game developed and published by Ubisoft.',
        75
    ),
    (
        'Kingdom Come: Deliverance',
        'Multi-platform',
        70.0,
        'Action RPG',
        2018,
        'Action role-playing video game developed by Warhorse Studios.',
        81
    ),
    (
        'Far Cry 6',
        'Multi-platform',
        60.0,
        'FPS',
        2021,
        'First-person shooter game developed by Ubisoft Toronto.',
        62
    ),
    (
        'Far Cry 5',
        'Multi-platform',
        40.0,
        'FPS',
        2018,
        'First-person shooter game developed by Ubisoft Montreal and Ubisoft Toronto.',
        80
    ),
    (
        'Far Cry 3',
        'Multi-platform',
        15.0,
        'FPS',
        2012,
        'First-person shooter developed by Ubisoft Montreal.',
        119
    ),
    (
        'Assassin''s Creed Valhalla',
        'Multi-platform',
        130.0,
        'Action RPG',
        2020,
        'Action role-playing video game developed by Ubisoft Montreal.',
        56
    ),
    (
        'Assassin''s Creed Odyssey',
        'Multi-platform',
        110.0,
        'Action RPG',
        2018,
        'Action role-playing video game developed by Ubisoft Quebec.',
        141
    ),
    (
        'Assassin''s Creed Origins',
        'Multi-platform',
        75.0,
        'Action RPG',
        2017,
        'Action role-playing video game developed by Ubisoft Montreal.',
        67
    ),
    (
        'Watch Dogs: Legion',
        'Multi-platform',
        90.0,
        'Action-Adventure',
        2020,
        'Action-adventure game developed by Ubisoft Toronto.',
        142
    ),
    (
        'Tom Clancy''s Rainbow Six Siege',
        'Multi-platform',
        85.0,
        'FPS',
        2015,
        'Online tactical shooter video game developed by Ubisoft Montreal.',
        58
    ),
    (
        'Tom Clancy''s The Division 2',
        'Multi-platform',
        110.0,
        'TPS',
        2019,
        'Online-only action role-playing video game developed by Massive Entertainment.',
        59
    ),
    (
        'Tom Clancy''s Ghost Recon Breakpoint',
        'Multi-platform',
        80.0,
        'TPS',
        2019,
        'Online tactical shooter video game developed by Ubisoft Paris.',
        52
    ),
    (
        'Just Cause 4',
        'Multi-platform',
        59.0,
        'Action-Adventure',
        2018,
        'Action-adventure game developed by Avalanche Studios.',
        90
    ),
    (
        'Saints Row',
        'Multi-platform',
        50.0,
        'Action-Adventure',
        2022,
        'Action-adventure game developed by Volition.',
        84
    ),
    (
        'Mafia: Definitive Edition',
        'Multi-platform',
        50.0,
        'Action-Adventure',
        2020,
        'Action-adventure video game developed by Hangar 13.',
        102
    ),
    (
        'L.A. Noire',
        'Multi-platform',
        30.0,
        'Action-Adventure',
        2011,
        'Neo-noir detective action-adventure video game developed by Team Bondi.',
        58
    ),
    (
        'Sleeping Dogs',
        'Multi-platform',
        20.0,
        'Action-Adventure',
        2012,
        'Action-adventure video game developed by United Front Games.',
        137
    ),
    (
        'Max Payne 3',
        'PC, PS3, Xbox 360',
        35.0,
        'TPS',
        2012,
        'Third-person shooter video game developed by Rockstar Studios.',
        79
    ),
    (
        'Quantum Break',
        'PC, Xbox One',
        68.0,
        'Action-Adventure',
        2016,
        'Science fiction action-adventure third-person shooter video game developed by Remedy Entertainment.',
        110
    ),
    (
        'Star Wars Jedi: Survivor',
        'PC, PS5, Xbox Series X/S',
        155.0,
        'Action-Adventure',
        2023,
        'Action-adventure game developed by Respawn Entertainment.',
        108
    ),
    (
        'Star Wars Jedi: Fallen Order',
        'Multi-platform',
        55.0,
        'Action-Adventure',
        2019,
        'Action-adventure game developed by Respawn Entertainment.',
        99
    ),
    (
        'Star Wars Battlefront II',
        'Multi-platform',
        90.0,
        'FPS/TPS',
        2017,
        'Action shooter video game based on the Star Wars franchise.',
        148
    ),
    (
        'Lego Star Wars: The Skywalker Saga',
        'Multi-platform',
        40.0,
        'Action-Adventure',
        2022,
        'Lego-themed action-adventure game developed by Traveller''s Tales.',
        149
    ),
    (
        'Marvel''s Guardians of the Galaxy',
        'Multi-platform',
        80.0,
        'Action-Adventure',
        2021,
        'Action-adventure video game developed by Eidos-Montréal.',
        72
    ),
    (
        'Marvel''s Avengers',
        'Multi-platform',
        100.0,
        'Action-Adventure',
        2020,
        'Action-adventure video game developed by Crystal Dynamics.',
        17
    ),
    (
        'Batman: Arkham Knight',
        'Multi-platform',
        55.0,
        'Action-Adventure',
        2015,
        'Action-adventure game developed by Rocksteady Studios.',
        43
    ),
    (
        'Batman: Arkham City',
        'Multi-platform',
        20.0,
        'Action-Adventure',
        2011,
        'Action-adventure game developed by Rocksteady Studios.',
        9
    ),
    (
        'Batman: Arkham Asylum',
        'Multi-platform',
        10.0,
        'Action-Adventure',
        2009,
        'Action-adventure game developed by Rocksteady Studios.',
        56
    ),
    (
        'Suicide Squad: Kill the Justice League',
        'PC, PS5, Xbox Series X/S',
        65.0,
        'Action-Adventure',
        2024,
        'Action-adventure game developed by Rocksteady Studios.',
        115
    ),
    (
        'Dredge',
        'Multi-platform',
        2.0,
        'Fishing',
        2023,
        'Sinister fishing adventure developed by Black Salt Games.',
        43
    ),
    (
        'Forspoken',
        'PC, PS5',
        150.0,
        'Action RPG',
        2023,
        'Action role-playing video game developed by Luminous Productions.',
        23
    ),
    (
        'Immortals of Aveum',
        'PC, PS5, Xbox Series X/S',
        70.0,
        'FPS',
        2023,
        'First-person shooter game developed by Ascendant Studios.',
        15
    ),
    (
        'Remnant 2',
        'PC, PS5, Xbox Series X/S',
        80.0,
        'TPS',
        2023,
        'Third-person shooter action role-playing video game developed by Gunfire Games.',
        121
    ),
    (
        'Lies of P',
        'Multi-platform',
        50.0,
        'Action RPG',
        2023,
        'Action role-playing video game developed by Neowiz Games and Round8 Studio.',
        20
    ),
    (
        'Lords of the Fallen',
        'PC, PS5, Xbox Series X/S',
        60.0,
        'Action RPG',
        2023,
        'Action role-playing video game developed by Hexworks.',
        132
    ),
    (
        'Armored Core VI: Fires of Rubicon',
        'Multi-platform',
        60.0,
        'Action',
        2023,
        'Mecha-based vehicular combat game developed by FromSoftware.',
        139
    );

