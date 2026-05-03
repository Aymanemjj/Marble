import { onMounted, onUnmounted, ref, watch } from "vue";
import { loadPieces } from "../services/PieceService";
import { useRoute } from "vue-router";

export function useHomeData() {
  const route = useRoute();
  const pieces = ref([]);
  const scrollComponent = ref(null);
  const selectedTab = ref("Pieces");
  const seen = new Set();
  const creators = ref([]);

  const extractArtists = (newPieces) => {
    newPieces.forEach(piece => {
      if (!seen.has(piece.creator.id)) {
        seen.add(piece.creator.id);
        creators.value.push(piece.creator);
      }
    });
  };

  const loadMorePieces = async () => {
    const newPieces = await loadPieces(route.query);
    pieces.value.push(...newPieces);
    extractArtists(newPieces);
  };

  // reset everything when query changes
  watch(() => route.query, async (query) => {
    pieces.value = [];
    creators.value = [];
    seen.clear();
    const newPieces = await loadPieces(query);
    pieces.value = newPieces;
    extractArtists(newPieces);
  });

  onMounted(async () => {
    const newPieces = await loadPieces(route.query);
    pieces.value = newPieces;
    extractArtists(newPieces);
    window.addEventListener("scroll", handleScroll);
  });

  onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
  });

  const handleScroll = () => {
    const element = scrollComponent.value;
    if (element.getBoundingClientRect().bottom < window.innerHeight - 700) {
      loadMorePieces();
    }
  };

  return { pieces, creators, scrollComponent, selectedTab };
}