# Welcome to Subscribers DB!

## Demo

You can find demo project [here](http://mailerlite.pabreza.lt/subscribers).


## Requirements

**Install  [Docker](https://docs.docker.com/install/)**
**Install  [Docker Compose](https://docs.docker.com/compose/install/)**
The Rest of the tools will run from inside the container.

## Installation
```
# Clone the repository from GitHub and open the directory:

git clone git@github.com:doobas/subscribersDB.git && cd subscribersDB

# Start Vessel and prepare the environment:

cp .env.example .env
./vessel start
./vessel composer install
./vessel art migrate --seed

# Prepare the frontend:

./vessel yarn install
./vessel yarn build 
```

**Access  [http://localhost](http://localhost/)**