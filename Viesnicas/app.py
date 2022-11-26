from flask import Flask, render_template, url_for, request, redirect
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///app.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)


class Article(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    room = db.Column(db.Integer, nullable=False)
    date = db.Column(db.Integer, nullable=False)

    def __repr__(self):
        return '<User %r>' % self.username


@app.route('/base')
def posts():
    articles = Article.query.order_by(Article.date).all()
    return render_template("base.html", articles=articles)


@app.route('/about')
def about():
    return render_template("about.html")


@app.route('/base/<int:id>/del')
def post_delete(id):
    article = Article.query.get_or_404(id)
    try:
        db.session.delete(article)
        db.session.commit()
        return redirect('/base')
    except:
        return "Delete Error"


@app.route('/')
def index():
    return render_template("index.html")


@app.route('/reservation.html', methods=['POST', 'GET'])
def reservation():
    if request.method == "POST":
        name = request.form['name']
        email = request.form['email']
        room = request.form['room']
        date = request.form['date']

        articles = Article(name=name, email=email, room=room, date=date)

        try:
            db.session.add(articles)
            db.session.commit()
            return redirect('/')
        except:
            return "Error, try later"

    else:
        return render_template("reservation.html")


if __name__ == "__main__":
    app.run(debug=True)
