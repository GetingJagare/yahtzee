import axios, { AxiosRequestConfig } from 'axios';
import { renderResult } from '../views/game';

export class Game {
    async getResult() {
        const result: AxiosRequestConfig = await axios.get('/backend/');
        return renderResult(result.data);
    }
}