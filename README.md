# GameMatch AI: Project Documentation

## 1. Project Overview

GameMatch AI is a web-based recommendation engine designed to help users discover their next favorite video game. Unlike static lists, this application uses an interactive quiz format to collect user preferences (device, available time, and mood) and processes this data to suggest a single, perfect game match.

## 2. Core Features

- **Interactive Quiz Interface**: A multi-step form with smooth transitions (slide-up, fade-in) that feels like a modern native app.
- **"Simulated AI" Experience**: The app features a processing screen with loading animations and dynamic text to simulate a complex algorithm analyzing the user's data.
- **Smart Filtering Algorithm**: Recommendations are not random. The app filters compatibility based on hardware and scores games based on the user's specific constraints.
- **Visual Polish**: Built with a "Gamer" aesthetic using a dark mode color palette (Slate 900) and neon accents (Violet 500), fully styled with Tailwind CSS.

## 3. How the "AI" Logic Works

The recommendation engine follows a three-step logic process in the JavaScript backend:

### Step 1: Hardware Filtering

The system first eliminates any games that are incompatible with the user's selected device.

- _Example_: If a user selects "Nintendo Switch", high-end PC-only games like League of Legends or Valorant (if added) would be immediately removed from the pool.

### Step 2: Preference Scoring

The remaining games are given a "Match Score" based on the user's other inputs:

- **Time Match (+2 Points)**: If the game length fits the user's schedule (e.g., "Short" vs "Long").
- **Vibe Match (+3 Points)**: If the game's genre matches the user's mood (e.g., "Relaxing" vs "Action").

### Step 3: Sorting & Selection

The array of games is sorted by their calculated score. The game with the highest score is presented as the "Perfect Match."

## 4. Technical Stack

- **HTML5**: Structural semantic markup.
- **Tailwind CSS**: Used for rapid styling, responsive grid layouts, and hover effects.
- **JavaScript (Vanilla)**: Handles state management (tracking current step), DOM manipulation (updating the screen), and the recommendation logic.
- **Lucide Icons**: Provides lightweight, scalable SVG icons for the UI.

## 5. User Flow

1.  **Onboarding**: User is welcomed and briefed on the tool.
2.  **Data Collection**:
    - **Input 1**: Device (PC, Console, Mobile, Switch).
    - **Input 2**: Time Availability (15m, 1h, 4h+).
    - **Input 3**: Mood/Goal (Relax, Compete, Think).
3.  **Processing**: A fake loading screen builds anticipation.
4.  **Result**: The best-matched game is revealed with an image, description, and a Google Search link.

## 6. How to Create a Git Repository

To create a new git repository for your project, follow these steps:

1.  **Initialize the repository**:
    Run the following command in your project directory:

    ```bash
    git init
    ```

2.  **Add files**:
    Stage your files for the first commit:

    ```bash
    git add .
    ```

3.  **Commit changes**:
    Save your changes with a descriptive message:

    ```bash
    git commit -m "Initial commit"
    ```

4.  **Push to remote (optional)**:
    If you have a remote repository (e.g., on GitHub), link it and push:
    ```bash
    git remote add origin <repository-url>
    git push -u origin main
    ```
