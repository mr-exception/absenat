from time import time
import json

def normilize_user_object (user):
  del user['id_str']
  del user['status']
  del user['statuses_count']
  del user['favourites_count']
  del user['listed_count']
  del user['friends_count']
  del user['followers_count']
  del user['following']
  del user['follow_request_sent']
  del user['notifications']
  del user['translator_type']

  user['last_user_fetch'] = time()
  
  return user

def normilize_tweet_object (tweet, user):
  del tweet['user']
  del tweet['id_str']
  del tweet['source']
  del tweet['in_reply_to_status_id_str']
  del tweet['in_reply_to_user_id_str']
  del tweet['in_reply_to_status_id']
  del tweet['in_reply_to_user_id']
  
  tweet['user_id'] = user['_id']
  return tweet

# geting user informations
def fetch_user(screen_name, users_collection, api):
  user = api.get_user(screen_name)._json
  user = normilize_user_object(user)
  
  old_user = users_collection.find_one({'id': user['id']})
  if old_user != None:
    print('> updated user {}'.format(screen_name))
    users_collection.update_one({'_id': old_user['_id']}, {'$set': user})
  else:
    print('+ got new user {}'.format(screen_name))
    user['last_tweets_fetch']     = 0
    user['last_followers_fetch']  = 0
    user['last_freinds_fetch']    = 0
    users_collection.insert_one(user)

# fetch tweets
def fetch_user_tweets(screen_name, tweets_collection, users_collection, api):
  print('> checks {} in db'.format(screen_name))
  user = users_collection.find_one({'screen_name': screen_name})
  if user == None:
    fetch_user(screen_name, users_collection, api)
  else:
    print('= users {} exists in db'.format(screen_name))
  user = users_collection.find_one({'screen_name': screen_name})
  
  # calculating the offset id
  tweet_id_offset = None
  tweets_count = tweets_collection.count({'user_id': user['_id']})
  if tweets_count >0:
    last_tweets = tweets_collection.find({'user_id': user['_id']}, {'id': 1}).sort('_id', 1).limit(1)[0]
    tweet_id_offset = last_tweets['id']
    print('> offset updated: {}'.format(tweet_id_offset))
  # print(last_tweets)
  # return

  max_tweets_fetch = 1000
  tweets = []
  for i in range(1, int(max_tweets_fetch/200)+1):
    print('+ retriving page {} tweets of {}'.format(i, screen_name))
    tweets_got = api.user_timeline(screen_name, count=200, page=i, since_id=tweet_id_offset)
    for i,tweet in enumerate(tweets_got):
      tweets_got[i] = normilize_tweet_object(tweet._json, user)
    tweets += tweets_got
    if len(tweets_got) < 200:
      break
  print('> got {} tweets'.format(len(tweets)))
  if len(tweets) > 0:
    tweets_collection.insert_many(tweets)
  users_collection.update({'_id': user['_id']}, {'$set': {'last_tweets_fetch': time()}})