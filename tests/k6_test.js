// k6 run k6_test.js
import http from "k6/http";
import { check, sleep } from "k6";

export let options = {
  scenarios: {
    ten_users: {
      executor: "constant-vus",
      vus: 10,
      duration: "30s",
      tags: { test_type: "10_users" },
    },
    fifty_users: {
      executor: "constant-vus",
      vus: 50,
      duration: "30s",
      startTime: "35s",
      tags: { test_type: "50_users" },
    },
    hundred_users: {
      executor: "constant-vus",
      vus: 100,
      duration: "30s",
      startTime: "70s",
      tags: { test_type: "100_users" },
    },
  },
  thresholds: {
    http_req_duration: ["p(95)<500"],
  },
};

const baseUrl = "http://localhost/biblioteka";

export default function () {
  let authorsResponse = http.get(`${baseUrl}/author`);
  check(authorsResponse, {
    "lista autorów - status 200": (r) => r.status === 200,
  });

  let booksResponse = http.get(`${baseUrl}/book`);
  check(booksResponse, {
    "lista książek - status 200": (r) => r.status === 200,
  });

  if (authorsResponse.body.includes("<td>")) {
  }

  if (booksResponse.body.includes("<td>")) {
  }

  let authorPayload = {
    first_name: `Test${Math.floor(Math.random() * 1000)}`,
    last_name: `Autor${Math.floor(Math.random() * 1000)}`,
  };

  let addAuthorResponse = http.post(
    `${baseUrl}/author/addAuthor`,
    authorPayload,
    { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
  );

  check(addAuthorResponse, {
    "dodanie autora - przekierowanie lub 200": (r) =>
      r.status === 200 || r.status === 302,
  });

  sleep(1);
}
