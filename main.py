import tweepy
import json
import pymongo
from time import time

# my libraries
from utilities import fetch_user, fetch_user_tweets

CONSUMER_KEY = 'B2u1U1euSIqpJPpNSAL0Gty96'
CONSUMER_SECRET = 'zGrPQdZNjdtzNAMLkWj60p3XLnbuVc37nepzE0vq5xW1AA7miU'

# auth for tweeter
auth = tweepy.AppAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
api = tweepy.API(auth, wait_on_rate_limit=True)
print('cenncted to tweeter successfully!')
# connect to mongodb
myclient = pymongo.MongoClient("mongodb://localhost:27017/")
mydb = myclient["absenat"]
print('connected to mongodb successfully!')

users_collection = mydb["users"]
tweets_collection = mydb["tweets"]

def update_existing_users():
  for user in users_collection.find({'last_user_fetch': {'$lt': time() - 3600}}, {'screen_name': True}).limit(100):
    screen_name = user['screen_name']
    fetch_user(screen_name, users_collection, api)

def fetch_new_users(sreen_names):
  for screen_name in sreen_names:
    fetch_user(screen_name, users_collection, api)


# fetch_new_users(['Rairhahs', 'amir_abbas', 'NaraghiAnita', 'alibordbari', 'arastuq'])
# update_existing_users()
fetch_user_tweets('reza_binazar', tweets_collection, users_collection, api)