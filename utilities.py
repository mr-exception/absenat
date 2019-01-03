def clean_user_object (user):
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

  return user
