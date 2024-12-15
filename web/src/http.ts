import axios, { type AxiosInstance } from "axios";

const http: AxiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/',
  headers: {
    "Content-type": "application/json",
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
    "Access-Control-Allow-Credentials": "true",
  },
});

export default http;
