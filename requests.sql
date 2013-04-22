#1 get clients names
SELECT name from clients;
#2 add facebook id to clients table
ALTER TABLE clients ADD facebook VARCHAR(60) AFTER name;