import http from './api'

export function addFavorite(data) {
  return http.post(`/favorite`,data)
}
export function fetchFavorites() {
  return http.get(`/favorites`)
}

export function fetchFavoriteByUser(id) {
  return http.get(`/favorite/${id}`)
}
