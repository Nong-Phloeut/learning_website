import http from './api'

export function register(data) {
  return http.post(`/register`,data)
}
export function login(data) {
  return http.post(`/login`,data)
}
export function logout() {
  return http.post(`/logout`,)
}
export function fetchUser() {
  return http.get(`/user`,)
}
