import requests
from bs4 import BeautifulSoup
HACKER_NEWS_URL = "https://news.ycombinator.com/"
STORE_URL = "http://127.0.0.1:8000/api/item/store"
DELETE_URL = "http://127.0.0.1:8000/api/items/delete"
page = requests.get(HACKER_NEWS_URL)

soup = BeautifulSoup(page.content, "html.parser")

results = soup.find_all("tr", class_="athing")

result = requests.post(url = DELETE_URL)

for result in results:
    if (result):
        rank = result.find("span", class_="rank").text.replace(".", "")
        title = result.find("span", class_="titleline")
        link = title.find("a")
        nextSibling = result.findNext("tr")
        score = nextSibling.find("span", class_="score")
        dateCreated = nextSibling.find("span", class_="age")

        points = 0;
        if (score):
            points = score.text.strip().replace(" points", "");

        data = {
            "item": {
                "rank": rank,
                "title": title.text,
                "link": link['href'],
                "points": points,
                "post_created_at": dateCreated['title']
            }
        }

        result = requests.post(url = STORE_URL, json = data)