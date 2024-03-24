import { ref } from "vue";

export const useLanguage = () => {
    const change = (lang: string) => {
        language.value = lang;
    };

    const language = ref("en");

    return {
        language,
        change,
    };
};
