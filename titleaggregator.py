from flask import Flask, render_template
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

@app.route('/')
def home():
    url = "https://sea.mashable.com/"
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    articles = soup.find_all('div', {'id': 'new'})

    titles = []
    for article in articles:
        title_div = article.find('div', {'class': 'caption'})
        if title_div:  # Check if the div was found
            title = title_div.get_text()
            link = article.find('a').get('href')
            titles.append({'title': title, 'link': link})

    return render_template('home.html', titles=titles)

if __name__ == '__main__':
    app.run(debug=True)

