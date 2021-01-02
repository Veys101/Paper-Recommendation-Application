import sys
import json
import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import sigmoid_kernel
from sklearn.metrics.pairwise import linear_kernel
from sklearn.metrics.pairwise import euclidean_distances
from sklearn.metrics.pairwise import cosine_similarity
from scipy.stats import pearsonr
import time

from pymongo import MongoClient


#This function helps to find the most similar papers to specified paper.
def calc_similarity(method_name,tfv_matrix):
    
    if method_name == 'sigmoid_kernel':
        matrix = sigmoid_kernel(tfv_matrix, tfv_matrix,gamma = 0.8, coef0=0.5)
    elif method_name == 'linear_kernel':
        matrix = linear_kernel(tfv_matrix, tfv_matrix)
    elif method_name == 'euclidean_distances':
        matrix = euclidean_distances(tfv_matrix)
    elif method_name == 'cosine_similarity':
        matrix = cosine_similarity(tfv_matrix,tfv_matrix)
    elif method_name == 'pearsons_correlation':
        tfv_array = tfv_matrix.toarray()
        matrix = []
        for i in range(len(tfv_array)):
             matrix.append(pearsonr(tfv_array[ind], tfv_array[i])[0])
        
    
    return matrix
    
def give_rec(title, matrix,papers_df):
    
    # Reverse mapping of indices and paper titles
    indices = pd.Series(papers_df.index, index=papers_df['title']).drop_duplicates()

    # Get the index corresponding to title
    idx = indices[title]

    # Get the pairwsie similarity scores 
    sig_scores = list(enumerate(matrix[idx]))

    # Sort the paper 
    sig_scores = sorted(sig_scores, key=lambda x: x[1], reverse=True)

    # Scores of the 10 most similar papers
    sig_scores = sig_scores[1:11]
    
    data = []
    count = 0
    while count<10:
        data.append([(papers_df.iloc[sig_scores[count][0]].id),(papers_df['all_content'].iloc[sig_scores[count][0]]), sig_scores[count][1]])
        count=count+1

    df = pd.DataFrame(data, columns = ["paper_id", "title", "score"])
    return df

def main(title):
    client = MongoClient('mongodb://localhost:27017')
    db = client['Paper']
    collection = db['Papers']
    
    if bool(list(collection.find({'title' : title}))):
        
        data = collection.find({})
        data_list = list(data)
        papers_df = pd.DataFrame(data_list)
        papers_df.drop(columns=['_id'],inplace=True)

       
        #ind = indices['Semi-Supervised Learning with Ladder Networks']
        
        tfv = TfidfVectorizer(max_features=None, 
                strip_accents='unicode', analyzer='word',token_pattern=r'\w{3,}',
                ngram_range=(1, 3),
                stop_words = 'english')
                
        papers_df['all_content'] =  papers_df['title'] 
        tfv_matrix = tfv.fit_transform(papers_df['all_content'])
        
        matrix = calc_similarity('cosine_similarity',tfv_matrix)
        
        print(give_rec(title,matrix,papers_df).head(10).to_json())
    else:
        print()

if __name__ == "__main__":
    main(sys.argv[1])
