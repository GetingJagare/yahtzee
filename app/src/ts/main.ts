import '../scss/main.scss';
import { Form } from './blocks/form';
import { Game } from './blocks/game';

document.addEventListener('DOMContentLoaded', () => {
    const form: Form = new Form('#game-form');
    const game: Game = new Game();

    form.element.addEventListener('submit', async () => {
        form.setResult(await game.getResult());
    });
});