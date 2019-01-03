import tweepy

CONSUMER_KEY = ''
CONSUMER_SECRET = ''


auth = tweepy.AppAuthHandler(consumer_key, consumer_secret)
api = tweepy.API(auth)

print(api)