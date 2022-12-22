<script>
export default {

  data() {
    return {
      question: "",
      aiResponse: [],
      heading: "",
      loading: false
    }
  },


  methods: {
    async chatGpt(question) {
      try {
        const data = { question };
        const response = await axios.post('/api/openai', data)
        this.aiResponse = response.data?.choices;
        this.heading = question
      } catch (error) {
        throw error.getMessage()
      }

    },

    async submitRequest() {
      try {
        this.loading = true
        await this.chatGpt(this.question)
      } catch (error) {
        console.log(error);
      } finally {
        this.loading = false
      }
    }

  },

}
</script>

<template>
  <div class="gpt">
    <div class="form-container">
      <h1>Generate Text Instantly with AI-Powered Autocomplete</h1>
      <div class="form">
        <textarea class="text-area" v-model="question" rows="5" placeholder="Ask me anything ..."></textarea>
      </div>
      <button :disabled="loading" class="btn" @click="submitRequest">
        <span v-if="loading">Doing science ...</span>
        <span v-else>Ask the AI</span>
      </button>
    </div>
    <div v-if="aiResponse.length > 0" class="answer-container">
      <h2>{{ heading }}</h2>
      <p v-for="(choice, i) in aiResponse" :key="i" v-html="choice.text"></p>
    </div>
    <div v-else class="answer-container">
      <p>
        Try typing a few words and watch as AI-powered autocomplete suggests
        related words and phrases to help you finish your sentence. No matter what you’re
        writing about, AI-powered autocomplete can help you generate text instantly.
      </p>
    </div>
  </div>
</template>

<style scoped>

</style>
