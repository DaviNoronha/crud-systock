/* eslint-disable @typescript-eslint/no-explicit-any */
import http from "@/http";

class BaseService {

  get(endpoint: string): Promise<any> {
    return http.get(`${endpoint}`);
  }

  post(endpoint: string, data: any): Promise<any> {
    return http.post(`${endpoint}`, data);
  }

  put(endpoint: string, data: any): Promise<any> {
    return http.put(`${endpoint}`, data);
  }

  delete(endpoint: string): Promise<any> {
    return http.delete(`${endpoint}`);
  }
}

export default new BaseService();
