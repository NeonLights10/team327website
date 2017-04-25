# team327website

### Information Storage Structure
Each team that signs up for the service recieves their own collection in the mongo DB. 
What this does is each team has their own information on teams, which is separate and unaccessable by the other teams.
Basically, each team has it's own set of data that it can view.

However, there is a global comment system that is shared across all teams, and every team can make comments and view comments from other teams on entries. 

Within the database itself, there is a template collection called "teams" which contains basic information that the team collections will copy from and update periodically.

Next to that, there is the "comments" collection, which stores all comments for any team.

Finally, each team has their own collection, named with their team number.

### Page Function Breakdown
