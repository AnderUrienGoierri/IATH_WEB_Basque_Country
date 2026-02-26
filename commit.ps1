git rm --ignore-unmatch "index.html" "style.css" "Aztertu dut sqldatabase_setup.txt"
git commit -m "Remove old index, style, and analysis files"

git add README.md
git commit -m "Update project documentation with local setup instructions"

git add css/common.css
git commit -m "Add common styling components"

git add css/videogames.css
git commit -m "Add dedicated styles for the videogame catalog"

git add js/videogames.js
git commit -m "Add interactive filtering and sorting for game catalog"

git add php/conexionDB.php
git commit -m "Add database connection script"

git add php/index.php
git commit -m "Add main landing page logic"

git add php/videogames.php
git commit -m "Implement dynamic catalog view"

git add php/videogame_details.php
git commit -m "Implement dynamic game details pages"

git add sql/
git commit -m "Update database schemas and setup scripts"

git add videogame_images/
git commit -m "Add cover images for the videogame database"

git add .
git commit -m "Commit any remaining UI and script updates"

git checkout main
git merge ander-branch
git remote set-url origin https://github.com/AnderUrienGoierri/IATH_WEB_Basque_Country.git
git push origin main
git checkout ander-branch
git push origin ander-branch
