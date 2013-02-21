scorecard
==========

Clone of scorecard web app for storing and retrieval of result from raw form of data

how it works
==========

The result was available in form of a pdf file, so first I had to convert it into a parsable format. I did this by simply copying the textual part of the entire pdf file and saving it as a txt file with each column being space seperated.

Example:-

    12114003 ABHISHEK KANDOI MA-101 MATHEMATICS-I 4 A CSE First Year - 1st Sem

The problem with this kind of raw data was that if I seperated each line of the data by using a whitespace I could not properly figure out each field individually, since many of them had names made up of three words. So I thought of reading through each column for a particular row and searched for the appearance of a "-"(dash) so that I could seperate the name properly. I went on like this and made a php script to store the raw data into a more meaningful form as a table in MySQL.

Contact Me
==========

Feel free to contact me at abhikandoi2000@gmail.com, and I shall try my best to reply as soon as possible.
