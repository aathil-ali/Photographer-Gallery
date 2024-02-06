// store/albums.js
const state = {
    albums: [],
  };
  
  const getters = {
    albums: (state) => state.albums,
  };
  
  const actions = {
    fetchAlbums: async ({ commit, rootGetters }) => {
      try {
        const token = rootGetters['authToken'];
  
        // Check if the token is available
        if (!token) {
          console.error('Token not available');
          return;
        }
  
        const response = await fetch(`${process.env.VUE_APP_API_URL}/api/album`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
          },
        });
  
        const data = await response.json();
  
        if (!response.ok) {
          throw new Error(data.message || 'Failed to fetch albums');
        }
  
        // Commit the fetched albums to the Vuex store
        commit('setAlbums', data.data);
  
      } catch (error) {
        console.error('Error fetching albums:', error.message);
      }
    },
  };
  
  const mutations = {
    setAlbums: (state, albums) => {
      state.albums = albums;
    },
  };
  
  export default {
    state,
    getters,
    actions,
    mutations,
  };
  