
import { initializeApp } from 'firebase/app';
import { getFirestore } from 'firebase/firestore';

const firebaseConfig = {
  apiKey: "AIzaSyD0gpMavVV3WrgXPnq9bdYrWzhz4qjxW4U",
  authDomain: "praksadb.firebaseapp.com",
  projectId: "praksadb",
  storageBucket: "praksadb.firebasestorage.app",
  messagingSenderId: "643566878299",
  appId: "1:643566878299:web:941999afa9c3e6990c497e"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

export { db };
