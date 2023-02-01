# How To Dockerize When Deploying

-   First, every changes you made, you need to rebuild the images. Run the command below.
-   The `-t` flag is a **Tag** everytime we change/commit something it is a best practice to tag it.
-   The `prod/epcstidsystem` is just a naming convention to name the tag, _prod_ for production ready and then _epcstidsystem_ which is the name of the app.
-   The `0.1` is the version, this is cumulative. So every rebuild you must increment it.

```pwsh
docker build -t prod/epcstidsystem:0.2 .
```

-   After running the command above, it will install all the dependencies to docker. It will take some time to finish.

-   After its done, make sure to run the command below, to spin-up the dockerize version of the system.

```pwsh
docker run -p 8080:80 prod/epcstidsystem:0.1
```

-   The command above will run the system using docker in port **8080** using the specified version which is 0.1. You can now access the dockerize system through `localhost:8080`.

-   To check all the available versions of the system/application. You can simply go to **Docker Desktop** application and go to **Images** tab, there you'll see all the available versions, including the name of all the applications.

# Notes

-   The file `Dockerfile` is very important. Do not change it unless you know how to configure it.

-   You also need **Ubuntu WSL version 2** and set it to default.
