import tweepy
import json
from utilities import clean_user_object

CONSUMER_KEY = 'B2u1U1euSIqpJPpNSAL0Gty96'
CONSUMER_SECRET = 'zGrPQdZNjdtzNAMLkWj60p3XLnbuVc37nepzE0vq5xW1AA7miU'

screen_name = 'reza_binazar'

# auth for tweeter
auth = tweepy.AppAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
api = tweepy.API(auth)

# geting user informations
user = api.get_user(screen_name)._json
user = clean_user_object(user)
print(json.dumps(user))