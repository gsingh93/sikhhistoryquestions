# Sikh History Questions

A website for learning Sikh History. The questions are taken from the Sterling Heights Gurdwara Punjabi class curriculum. A demo can be found [here](http://www.michigangurudwara.com/sikhhistoryquestions/).

## Usage

1. Run `generate-questions.py` on a questions file. The input file should be a text file, the output file is a JSON file. See the comments in `generate-questions.py` for the formats of both of these files.

2. Run `mv config.py.example config.py` and modify the file with your database information.

3. Run `initdb.py` to load the questions from the generated JSON file into the database.

4. Run `mv www/config.php.example config.php` and modify the file with your database information.

5. Configure `www` as the root of your web server
