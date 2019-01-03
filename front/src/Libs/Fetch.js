const Twitter = require('twitter');
const OAuth2 = require('oauth').OAuth2; 

const oauth2 = new OAuth2('B2u1U1euSIqpJPpNSAL0Gty96', 'zGrPQdZNjdtzNAMLkWj60p3XLnbuVc37nepzE0vq5xW1AA7miU', 'https://api.twitter.com/', null, 'oauth2/token', null);

const fetchUser = (username, finished, failed, setState) => {
  oauth2.getOAuthAccessToken('', {
    'grant_type': 'client_credentials'
  }, function (e, bearer_token) {
      // got bearer token
      const client = new Twitter({
        consumer_key: 'B2u1U1euSIqpJPpNSAL0Gty96',
        consumer_secret: 'zGrPQdZNjdtzNAMLkWj60p3XLnbuVc37nepzE0vq5xW1AA7miU',
        bearer_token,
      });
      const results = {};
      let progress = 0;
      // get user informations`
      client.get('users/show', {screen_name: username}).then(function(info){
        // console.log(`got info`);
        progress += 10;
        setState({log: 'got info', progress})
        results.info = info;
      }).catch(function(error){
        console.log(error);
      });
      // get followers
      client.get('followers/list', {screen_name: username}).then(function(followers){
        // console.log(`got ${followers.users.length} followers`);
        progress += 20;
        setState({log: `got ${followers.users.length} followers`, progress})
        results.followers = followers;
      }).catch(function(error){
        console.log(error);
      });
      // get friends
      client.get('friends/list', {screen_name: username}).then(function(friends){
        // console.log(`got ${friends.users.length} friends`);
        progress += 20;
        setState({log: `got ${friends.users.length} friends`, progress})
        results.friends = friends;
      }).catch(function(error){
        console.log(error);
      });
      // get tweets
      client.get('statuses/user_timeline', {screen_name: username}).then(function(tweets){
        // console.log(`got ${tweets.length} tweets`);
        progress += 50;
        setState({log: `got ${tweets.length} tweets`, progress})
        results.tweets = tweets;
      }).catch(function(error){
        console.log(error);
      });
  });
}
module.exports = {
  fetchUser,
}

