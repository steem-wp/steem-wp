
var client = new dsteem.Client('https://api.steemit.com')
	
var app = new Vue({
  el: '#app',
  data: {
      posts: []
  },
  mounted () {
    this.getPosts()
  },
  methods: {
    first_img(text) {
      return text.match(/(https?:\/\/.*\.(?:png|jpg|jpeg|gif|png|svg))/i)[0];
	},
    async getPosts () {
        this.posts = await client.database.getDiscussions('blog', {tag: 'steemwp.com', limit: 10})
    }
  },
  template: `
    <div>
        
        <div style="display:none" ref="workingText"></div>
        
        <div v-for="(post, index) in posts" :key="index">
            
            <div class="row steemwp-row" style="margin-bottom: 1rem">
                <div class="two columns steemwp-columns">
                    <img :src="first_img(post.body)" style="width: 80px; max-height: 45px">
                </div>
                <div class="ten columns steemwp-columns">
                    <div class="row steemwp-row">
                        <div class="ten columns steemwp-columns">
                            <b><a :href="'https://steemit.com' + post.url" target="_blank" style="vertical-align: center">{{post.title}}</a></b>
                        </div>
                        <div class="two columns steemwp-columns">
                            <small>{{new Date(post.created).toDateString()}}</small>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
  `
});