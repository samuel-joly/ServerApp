#!/usr/bin/env bash

if [[ -z $1 ]]; then
    echo Running User tests
    newman run ./pp6-forum-UserTest.postman_collection.json -e ./pp6-User-environment.json
    if [[ $? -ne 0 ]]; then
        echo User tests failed
    else
        echo User tests succeeded
    fi
else
    echo Running Admin tests
    newman run ./pp6-forum-AdminTest.postman_collection.json -e ./pp6-Admin-environment.json
    if [[ $? -ne 0 ]]; then
        echo Admin tests failed
    else
        echo Admin tests succeeded
    fi
fi
