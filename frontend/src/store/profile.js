// store/profile.js

// Vuex store module for managing user profiles
const state = {
  // Initialize state for storing user profiles
  profile: [],
};

const getters = {
  // Getter method to retrieve user profiles from the state
  profile: (state) => state.profile,
};

const actions = {
  // Action method to fetch user profile data from the server
  fetchProfile: async ({ commit, rootGetters }) => {
    try {
      // Retrieve the authentication token from rootGetters
      const token = rootGetters['authToken'];

      // Check if the authentication token is available
      if (!token) {
        console.error('Token not available');
        return;
      }

      // Fetch user profile data from the server
      const response = await fetch(`${process.env.VUE_APP_API_URL}/api/profile`, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
      });

      // Extract JSON response data
      const responseData = await response.json();

      // Check if the response is successful
      if (!response.ok) {
        throw new Error(responseData.message || 'Failed to fetch profile');
      }
      // Commit the fetched user profile data to the Vuex store
      commit('setProfile', responseData.data);

    } catch (error) {
      console.error('Error fetching profile:', error.message);
    }
  },
};

const mutations = {
  // Mutation method to update the user profile state
  setProfile: (state, profile) => {
    state.profile = profile;
  },
};

// Export the profile module for Vuex store registration
export default {
  state,
  getters,
  actions,
  mutations,
};
