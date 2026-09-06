import { createRoot } from 'react-dom/client';
import BookingWidget from './BookingWidget.jsx';

document.querySelectorAll('[data-bonomali-booking]').forEach((el) => {
  let stays = [];
  try {
    stays = JSON.parse(el.dataset.stays || '[]');
  } catch (e) {
    stays = [];
  }

  createRoot(el).render(
    <BookingWidget
      stays={stays}
      quoteUrl={el.dataset.quoteUrl}
      availabilityUrl={el.dataset.availabilityUrl}
      reserveUrl={el.dataset.reserveUrl}
    />
  );
});
