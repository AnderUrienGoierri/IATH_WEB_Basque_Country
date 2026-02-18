CREATE DATABASE IF NOT EXISTS video_games_quiz_db;
USE video_games_quiz_db;
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