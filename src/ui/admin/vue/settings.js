
var app = new Vue({
  el: '#app',
  data: function() {
    return {
      ready: false, 
      settingsData: window._settingsData,
      account: window._settingsData.account,
      action: window._settingsData.action,
      activeTab: window.location.hash ? window.location.hash.substring(1) : 'general'
    }
  },
  template: `
    <div>
    
        <div style="margin-bottom: 2rem;">
            
             <ul class="tab-nav">
              <li>
                <a class="steemwp-button" :class="{ 'active': (activeTab === 'general') }" :href="'#general'" @click="activeTab = 'general'">General</a>
              </li>
            </ul>
        
        </div>
        
        
        <div class="tab-content">
        
          <div class="tab-pane" id="" v-if="activeTab === 'general'">
          
                <h6>Account</h6>
                
                <form :action="action" method="post">
                  <div class="steemwp-rowed">
                    <div style="font-size: 1rem;">Connected as <b><i> {{'@' + account}} </i></b> </div>
                    <input class="steemwp-button" type="submit" name="submit" value="Disconnect">
                  </div>
                </form>
                
          </div>
          
        </div>
        
    </div>
  `
});